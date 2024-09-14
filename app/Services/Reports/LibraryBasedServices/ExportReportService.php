<?php

namespace App\Services\Reports\LibraryBasedServices;

use App\Models\Student;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportReportService
    extends DefaultValueBinder
    implements Responsable,
    FromQuery,
    ShouldQueue,
    WithMapping,
    WithHeadings,
    WithCustomValueBinder,
    ShouldAutoSize,
    WithStyles,
    WithDefaultStyles
{
    use Exportable;

    private string $filterInput;

    public function __construct(string $filterInput)
    {
        $this->filterInput = $filterInput;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Student::query();
    }

    /**
     * [Method description].
     *
     * @param array $data
     * @param Model|null $row
     * @return array
     */
    public function handler(array $data, Model|null $row = null): array
    {
        $result = [];

        switch ($this->filterInput) {
            case 'department':
                $data[] = $this->getReportForDepartment($row);
                break;

            case 'accounting':
                $data[] = $this->getReportForAccounting($row);
                break;

            case 'educational':
                $data[] = $this->getReportForEducational($row);
                break;

            case 'inclusive':
                $data[] = $this->getReportForInclusive($row);
                break;

            case 'committee':
                $data[] = $this->getReportForCommittee($row);
                break;
        }

        array_walk_recursive($data, function ($item) use (&$result) {
            $result[] = $item;
        });

        return $result;
    }

    /**
     * @param Model $row
     * @return array
     */
    public function map($row): array
    {
        $data = [
            $row->id,
            $row->surname,
            $row->name,
            $row->patronymic ?? '—',

            $row->passport->gender === 'male' ? 'муж.' : 'жен.',
            date('d.m.Y', strtotime($row->passport->birthday)),
            $row->passport->nationality->name,
            $row->passport->birthplace,
            $row->passport->number,
            date('d.m.Y', strtotime($row->passport->issue_date)),
            $row->passport->issue_by,
            $row->passport->address_registered,
            $row->passport->address_residential,

            $row->pensionInsurance->number ?? '—',
            $row->enrollment->faculty->name ?? '—',
        ];

        if ($this->filterInput !== 'accounting') {
            $data[] = [
                $row->educational->avg_rating,
                $row->enrollment->is_budget ? 'Да' : 'Нет',
                $row->enrollment->is_budget || is_null($row->enrollment->faculty_id) ? 'Нет' : 'Да',
                $row->specialCircumstances[1]->pivot->status ? 'Да' : 'Нет',
                $row->specialCircumstances[2]->pivot->status ? 'Да' : 'Нет',
            ];
        }

        return $this->handler($data, $row);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $data = [
            'Дело, №',
            'Фамилия',
            'Имя',
            'Отчество',
            'Пол',
            'Дата рождения',
            'Гражданство',
            'Место рождения',
            'Серия и номер паспорта',
            'Дата выдачи паспорта',
            'Паспорт выдан',
            'Адрес по прописке',
            'Адрес проживания',
            'СНИЛС',
            'Зачислен на специальность',
        ];

        $extraData = [
            'Ср.балл',
            'Бюджет',
            'Внебюджет',
            'Инвалидность',
            'Общежитие',
        ];

        if ($this->filterInput !== 'accounting') $data[] = $extraData;

        return $this->handler($data);
    }

    /**
     * @throws Exception
     */
    public function bindValue(Cell $cell, $value): bool
    {
        if (is_string($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
            'A' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
            'E' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
            'F' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
            'J' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
            'N' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
        ];
    }

    /**
     * @param Style $defaultStyle
     * @return Font
     */
    public function defaultStyles(Style $defaultStyle): Font
    {
        return $defaultStyle->getFont()->setSize(12);
    }

    /**
     * [Method description].
     *
     * @param Model|null $row
     * @return array
     */
    private function getReportForDepartment(model|null $row = null): array
    {
        $headers = ['Ребёнок/участник СВО', 'Сирота'];

        if (is_null($row)) {
            return $headers;
        }

        try {
            return [
                $row->specialCircumstances[3]->pivot->status ? 'Да' : 'Нет',
                $row->specialCircumstances[4]->pivot->status ? 'Да' : 'Нет'
            ];
        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * [Method description].
     *
     * @param Model|null $row
     * @return array
     */
    private function getReportForAccounting(model|null $row = null): array
    {
        $headers = ['Номер телефона'];

        if (is_null($row)) {
            return $headers;
        }

        try {
            return [
                $row->phone ?? '—',
            ];
        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * [Method description].
     *
     * @param Model|null $row
     * @return array
     */
    private function getReportForEducational(model|null $row = null): array
    {
        $headers = ['Номер телефона', 'Ребёнок/участник СВО', 'Сирота'];

        if (is_null($row)) {
            return $headers;
        }

        try {
            return [
                $row->phone ?? '—',
                $row->specialCircumstances[3]->pivot->status ? 'Да' : 'Нет',
                $row->specialCircumstances[4]->pivot->status ? 'Да' : 'Нет',
            ];
        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * [Method description].
     *
     * @param Model|null $row
     * @return array
     */
    private function getReportForInclusive(model|null $row = null): array
    {
        $headers = ['Номер телефона', 'СПО впервые', 'Спец. условия'];

        if (is_null($row)) {
            return $headers;
        }

        try {
            return [
                $row->phone ?? '—',
                $row->educational->is_first_spo ? 'Да' : 'Нет',
                $row->specialCircumstances[0]->pivot->status ? 'Да' : 'Нет',
            ];
        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * [Method description].
     *
     * @param Model|null $row
     * @return array
     */
    private function getReportForCommittee(model|null $row = null): array
    {
        $headers = [
            'Номер телефона',
            'СПО впервые',
            'Ребёнок/участник СВО',
            'Сирота',
            'Год окончания образ-го учреждения',
            'Дата выдачи док-та об образовании',
            'Серия и номер док-та об образовании',
            'Номер приказа о зачислении',
            'Дата подачи док-ов',
        ];

        if (is_null($row)) {
            return $headers;
        }

        try {
            return [
                $row->phone ?? '—',
                $row->educational->is_first_spo ? 'Да' : 'Нет',
                $row->specialCircumstances[3]->pivot->status ? 'Да' : 'Нет',
                $row->specialCircumstances[4]->pivot->status ? 'Да' : 'Нет',
                date('Y', strtotime($row->educational->issue_date)),
                date('d.m.Y', strtotime($row->educational->issue_date)),
                $row->educational->ed_doc_number,
                $row->enrollment->decree->name ?? '—',
                date('d.m.Y', strtotime($row->created_at)),
            ];
        } catch (\Exception $exception) {
            return [];
        }
    }
}
