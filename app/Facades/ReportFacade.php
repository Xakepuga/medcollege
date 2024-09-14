<?php

namespace App\Facades;

use App\Models\Faculty;
use App\Models\FinancingType;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\SimpleType\Jc;
use function Symfony\Component\String\b;

class ReportFacade
{
    protected object $faculty;
    protected object $financing;
    protected object $student;

    public function __construct
    (
        Faculty       $faculty = null,
        FinancingType $financing = null,
        Student       $student = null,
    )
    {
        $this->faculty = $faculty ?: new Faculty();
        $this->financing = $financing ?: new FinancingType();
        $this->student = $student ?: new Student();
    }

    /**
     * [Method description].
     *
     * @param int $facultyId
     * @return Collection
     */
    private function generateRating(int $facultyId): Collection
    {
        return DB::table('students')
            ->join('educational', 'students.id', '=', 'educational.student_id')
            ->join('information_for_admission', 'students.id', '=', 'information_for_admission.student_id')
            ->join('financing_types', 'financing_types.id', '=', 'information_for_admission.financing_type_id')
            ->join('enrollment', 'students.id', '=', 'enrollment.student_id')
            ->join('student_special_circumstance', 'students.id', '=', 'student_special_circumstance.student_id')

            ->select(
                'students.id',
                'students.name as name',
                'students.surname as surname',
                'students.patronymic as patronymic',
                'educational.avg_rating as avg_rating',
                'information_for_admission.testing as testing',
                'information_for_admission.is_original_docs as is_original_docs',
                'financing_types.name as financing_type',
                'student_special_circumstance.status as special_circumstance',
            )

            ->where('information_for_admission.faculty_id', '=', $facultyId)
            ->where('enrollment.is_pickup_docs', '=', 0)
            ->where('student_special_circumstance.special_circumstance_id', '=', 4)

            ->orderBy('student_special_circumstance.status', 'desc')
            ->orderBy('information_for_admission.is_original_docs', 'desc')
            ->orderBy('educational.avg_rating', 'desc')
            ->orderBy('information_for_admission.testing', 'desc')
            ->orderBy('students.surname', 'asc')

            ->get();
    }

    /**
     * [Method description].
     *
     * @param string $reportName
     * @return Collection
     */
    private function generateReport(string $reportName): Collection
    {
        $students = $this->student->all()->sortBy('surname');

        if ($reportName !== 'accounting') {
            $students->load('educational', 'specialCircumstances', 'faculties');
        }

        $students->load('passport', 'enrollment', 'pensionInsurance');

        return $students;
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @param array|Collection $students
     * @return LengthAwarePaginator
     */
    private function customPaginator(Request $request, array|Collection $students): LengthAwarePaginator
    {
        $total = count($students);
        $per_page = config('paginate.studentsList');
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;

        if (is_array($students)) {
            $students = array_slice($students, $starting_point, $per_page, true);
        } else {
            $students = $students->slice($starting_point, $per_page);
        }

        return new LengthAwarePaginator($students, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @return array
     */
    public function showRating(Request $request): array
    {
        $faculties = $this->faculty->all();
        $students = null;

        if ($request['faculty_id']) {
            $students = $this->generateRating($request['faculty_id'])->toArray();
            //dd($students);
            $students = $this->customPaginator($request, $students);
        }

        return [
            'faculties' => $faculties,
            'students' => $students,
        ];
    }

    /**
     * [Method description].
     *
     * @param int $facultyId
     * @return string
     * @throws Exception
     */
    public function exportRatingToWord(int $facultyId): string
    {
        $facultyName = $this->faculty->find($facultyId)->name;
        $students = ($this->generateRating($facultyId))->toArray();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection(['orientation' => 'landscape']);

        $docTitleStyle = ['size' => 16, 'bold' => true];
        $tableHeaderStyle = ['size' => 12, 'bold' => true];
        $tableStyle = ['borderSize' => 0.5, 'borderColor' => '000000', 'alignment' => JcTable::CENTER];
        $tableTextStyle = ['size' => 12];
        $cellHCentered = ['alignment' => Jc::CENTER]; // Горизонтальное выравнивание текста в ячейке
        $cellVCentered = ['valign' => 'center']; // Вертикальное выравнивание текста в ячейке

        $rows = count($students);
        $rowValue = ['№', 'Фамилия', 'Имя', 'Отчество', 'Ср.балл', 'Тест', 'Документы', 'Финансирование'];

        $section->addText($facultyName, $docTitleStyle, ['align' => 'center']);
        $section->addTextBreak(1);
        $table = $section->addTable($tableStyle);

        $table->addRow();
        for ($i = 1; $i <= count($rowValue); ++$i) {
            $table->addCell(null, $cellVCentered)->addText($rowValue[$i - 1], $tableHeaderStyle, $cellHCentered);
        }

        for ($r = 1; $r <= $rows; ++$r) {
            $table->addRow();
            $table->addCell(700, $cellVCentered)->addText($r, $tableTextStyle, $cellHCentered);
            $table->addCell(2000, $cellVCentered)->addText($students[$r - 1]->surname, $tableTextStyle, $cellHCentered);
            $table->addCell(2000, $cellVCentered)->addText($students[$r - 1]->name, $tableTextStyle, $cellHCentered);
            $table->addCell(2000, $cellVCentered)->addText($students[$r - 1]->patronymic, $tableTextStyle, $cellHCentered);
            $table->addCell(1200, $cellVCentered)->addText($students[$r - 1]->avg_rating, $tableTextStyle, $cellHCentered);
            $table->addCell(700, $cellVCentered)->addText($students[$r - 1]->testing, $tableTextStyle, $cellHCentered);
            $table->addCell(1500, $cellVCentered)->addText($students[$r - 1]->is_original_docs ? 'Оригиналы' : 'Копии', $tableTextStyle, $cellHCentered);
            $table->addCell(2300, $cellVCentered)->addText($students[$r - 1]->financing_type, $tableTextStyle, $cellHCentered);
        }

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($facultyName . '.docx');

        return $facultyName;
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @return array
     */
    public function showUniversalReport(Request $request): array
    {
        $students = null;

        if ($request->input('report')) {

            $reportName = $request->input('report');

            $students = $this->generateReport($reportName);
            $students = $this->customPaginator($request, $students);
        }

        return ['students' => $students];
    }

    /**
     * [Method description].
     *
     * @return array
     */
    public function generateStatistics(): array
    {
        $data = [
            'countUniqueStudents' => [],
            'countOrigDocs' => [],
            'financingNames' => [],
            'faculties' => [],
            'rowTotal' => [],
        ];

        if ($this->faculty->all()->isnotEmpty()) {

            $financing = [];
            $totalCountAllFinancing = [];

            foreach ($this->financing->all() as $item) {
                // Запись одного значения сразу в две переменные
                $data['financingNames'][$item->id] = $financing[$item->id] = $item->name;
            }

            // Формируем данные по КАЖДОЙ специальности
            foreach ($this->faculty->all() as $faculty) {

                $data['faculties'][$faculty->id]['name'] = $faculty->name;

                // Подсчитываем кол-во оригиналов по КАЖДОЙ специальности
                $data['countOrigDocs'][] = $faculty->studentsPivotOrigDocs()->get()->count();

                foreach ($financing as $key => $name) {
                    // Запись одного значения сразу в две переменные
                    $data['faculties'][$faculty->id]['financing'][$name] = $fieldTotalForOneFaculty[] =
                        $faculty->studentsPivotFinancing($key)->get()->count();
                }

                $data['faculties'][$faculty->id]['totalCount'] = array_sum($fieldTotalForOneFaculty);
                $fieldTotalForOneFaculty = [];
            }

            // Формируем данные по ВСЕМ специальностям (строка "Итого")
            foreach ($financing as $key => $name) {
                foreach ($data['faculties'] as $faculty) {
                    // Запись одного значения сразу в две переменные
                    $totalCountForOneFinancing[] = $totalCountAllFinancing[] = $faculty['financing'][$name];
                }

                $data['rowTotal']['financing'][$name] = array_sum($totalCountForOneFinancing);
                $totalCountForOneFinancing = [];
            }

            $data['rowTotal']['totalCount'] = array_sum($totalCountAllFinancing);
            $data['countUniqueStudents'] = $this->student->all()->count();
            $data['countOrigDocs'] = array_sum($data['countOrigDocs']);

            return ['data' => $data];
        }

        return ['data' => null];
    }
}
