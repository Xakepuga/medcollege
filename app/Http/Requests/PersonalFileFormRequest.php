<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonalFileFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $student = Student::find($this->id);
        $passportId = $student->passport->id ?? null;

        $this->getFacultyIdWithOrigDocs();

        return [
            'surname' => 'alpha_dash|between:2,30|required',
            'name' => 'alpha_dash|between:2,30|required',
            'patronymic' => 'string|between:5,30|nullable',
            'gender' => 'alpha|between:4,6|required',
            'birthday' => 'date|required',
            'nationality' => 'integer|exists:App\Models\Nationality,id|required',
            'birthplace' => 'string|between:3,150|required',

            'passportNumber' => [
                'alpha_dash', 'between:5,20', 'required',
                Rule::unique('passports', 'number')->ignore($passportId),
            ],
            'issueDatePassport' => 'date|required',
            'issueBy' => 'string|between:10,150|required',

            'addressRegistered' => 'string|between:10,180|required',
            'addressResidential' => 'string|between:10,180|required',

            'pensionInsurance' => [
                'alpha_dash', 'between:11,20', 'nullable',
                Rule::unique('pension_insurance', 'number')->ignore($this->id, 'student_id'),
            ],

            'phone' => [
                'digits:11', 'integer', 'nullable',
                Rule::unique('students', 'phone')->ignore($this->id),
            ],
            'email' => [
                'email:rfc', 'nullable',
                Rule::unique('students', 'email')->ignore($this->id),
            ],

            'data.*.faculty_id' => 'integer|exists:App\Models\Faculty,id|required',
            'data.*.is_original_docs' => 'boolean|required',
            'data.*.financing_type_id' => 'integer|exists:App\Models\FinancingType,id|required',
            'data.*.testing' => 'numeric|min:1|max:10|nullable',

            'educationalInstitutionName' => 'string|between:3,255|required',
            'educationalInstitutionType' => 'integer|exists:App\Models\EducationalInstitutionType,id|required',
            'language' => 'integer|exists:App\Models\Language,id|required',
            'educationalDocType' => 'integer|exists:App\Models\EducationalDocType,id|required',
            'excellentStudent' => 'boolean|required',
            'educationalDocNumber' => [
                'alpha_dash', 'between:6,30', 'required',
                Rule::unique('educational', 'ed_doc_number')->ignore($this->id, 'student_id'),
            ],
            'issueDateEducationalDoc' => 'date|required',
            'avgRating' => 'numeric|min:1|max:5|required',
            'firstProfession' => 'boolean|required',

            'placeWork' => 'string|between:3,100|nullable',
            'profession' => 'string|between:3,75|nullable',
            'seniorityYears' => 'integer|between:1,100|nullable',
            'seniorityMonths' => 'integer|between:1,12|nullable',

            'circumstance' => 'array|required',
            'aboutMe' => 'string|min:5|max:300|nullable',

            'fatherSurname' => 'alpha_dash|between:2,30|nullable',
            'fatherName' => 'alpha_dash|between:2,30|nullable',
            'fatherPatronymic' => 'string|between:5,30|nullable',
            'fatherPhone' => [
                'digits:11', 'integer', 'nullable',
                Rule::unique('student_parent_fathers', 'phone')->ignore($this->id, 'student_id'),
            ],

            'motherSurname' => 'alpha_dash|between:2,30|nullable',
            'motherName' => 'alpha_dash|between:2,30|nullable',
            'motherPatronymic' => 'string|between:5,30|nullable',
            'motherPhone' => [
                'digits:11', 'integer', 'nullable',
                Rule::unique('student_parent_mothers', 'phone')->ignore($this->id, 'student_id'),
            ],

            'facultyAdmitted' => 'integer|exists:App\Models\Faculty,id|same:facultyWithOrigDocs|required_with:decree|nullable',
            'decree' => 'integer|exists:App\Models\Decree,id|required_with:facultyAdmitted|nullable',
            'pickupDocs' => 'boolean|required',
        ];
    }

    /**
     * [Method description].
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'passportNumber' => '«Серия и номер паспорта»',
            'issueDatePassport' => '«Дата выдачи»',
            'issueBy' => '«Паспорт выдан»',
            'addressRegistered' => '«Адрес по прописке»',
            'addressResidential' => '«Адрес проживания»',
            'pensionInsurance' => '«СНИЛС»',
            'educationalInstitutionName' => '«Наименование учебного заведения»',
            'educationalInstitutionType' => '«Тип учебного заведения»',
            'language' => '«Иностранный язык»',
            'educationalDocType' => '«Тип документа об образовании»',
            'excellentStudent' => '«Окончил обучение с отличием»',
            'educationalDocNumber' => '«Серия и номер документа»',
            'issueDateEducationalDoc' => '«Дата выдачи»',
            'avgRating' => '«Средний балл»',
            'firstProfession' => '«Абитуриент получает СПО впервые»',
            'placeWork' => '«Место работы»',
            'profession' => '«Должность, специализация»',
            'seniorityYears' => '«Стаж, лет»',
            'seniorityMonths' => '«Стаж, месяцев»',
            'aboutMe' => '«О себе»',
            'fatherSurname' => '«Фамилия»',
            'fatherName' => '«Имя»',
            'fatherPatronymic' => '«Отчество»',
            'fatherPhone' => '«Телефон»',
            'motherSurname' => '«Фамилия»',
            'motherName' => '«Имя»',
            'motherPatronymic' => '«Отчество»',
            'motherPhone' => '«Телефон»',
            'facultyAdmitted' => '«Зачислен на специальность»',
            'decree' => '«Номер приказа»',
            'facultyWithOrigDocs' => '«Специальность»',
            'pickupDocs' => '«Абитуриент забрал документы»',
            'data.*.testing' => '«Тестирование»',
        ];
    }

    /**
     * [Method description].
     *
     * @return void
     */
    private function getFacultyIdWithOrigDocs(): void
    {
        $faculties = $this->data;

        foreach ($faculties as $faculty) {
            if ($faculty['is_original_docs'] === '1') {
                $this['facultyWithOrigDocs'] = $faculty['faculty_id'];
            }
        }
    }
}
