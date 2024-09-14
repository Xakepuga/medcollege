<?php

namespace App\Facades;

use App\Models\Decree;
use App\Models\Enrollment;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListFacade
{
    protected object $faculty;
    protected object $decree;
    protected object $enrollment;
    protected object $student;

    public function __construct
    (
        Faculty    $faculty = null,
        Decree     $decree = null,
        Enrollment $enrollment = null,
        Student    $student = null,
    )
    {
        $this->faculty = $faculty ?: new Faculty();
        $this->decree = $decree ?: new Decree();
        $this->enrollment = $enrollment ?: new Enrollment();
        $this->student = $student ?: new Student();
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @return array
     */
    public function getList(Request $request): array
    {
        $faculties = $this->faculty->all();

        $facultyId = $request->input('faculty_id'); // int
        $financingTypesId = $request->input('financing_types'); // array
        $studentStatuses = $request->input('student_statuses'); // array
        $docsTypes = $request->input('docs_types'); // array

        $students = DB::table('students')

            ->join('information_for_admission', 'students.id', '=', 'information_for_admission.student_id')
            ->join('enrollment', 'students.id', '=', 'enrollment.student_id')
            ->join('faculties', 'faculties.id', '=', 'information_for_admission.faculty_id')
            ->join('financing_types', 'financing_types.id', '=', 'information_for_admission.financing_type_id')

            ->select('students.*', 'faculties.name as faculty')

            ->when($facultyId, function ($query, int $facultyId) {
                return $query->where('faculties.id', $facultyId);
            })
            ->when($financingTypesId, function ($query, array $financingTypesId) {
                return $query->whereIn('financing_types.id', array_values($financingTypesId));
            })
            ->when(isset($studentStatuses['enrolled']), function ($query) {
                return $query->whereNotNull('enrollment.decree_id');
            })
            ->when(isset($studentStatuses['not_enrolled']), function ($query) {
                return $query->whereNull('enrollment.decree_id');
            })
            ->when($docsTypes, function ($query, array $docsTypes) {
                return $query->whereIn('information_for_admission.is_original_docs', array_values($docsTypes));
            })

            ->orderBy('students.surname')
            ->paginate(config('paginate.studentsList'))->withQueryString();

        return [
            'faculties' => $faculties,
            'students' => $students,
        ];
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @return array
     */
    public function showFacultyStudents(Request $request): array
    {
        $faculties = $this->faculty->all();

        if ($request['faculty_id']) {

            $decrees = $this->decree->all();

            $students = DB::table('students')

                ->join('information_for_admission', 'students.id', '=', 'information_for_admission.student_id')
                ->join('enrollment', 'students.id', '=', 'enrollment.student_id')

                ->select('students.*', 'enrollment.decree_id as decree')

                ->where('information_for_admission.faculty_id', '=', $request['faculty_id'])
                ->where('information_for_admission.is_original_docs', '=', 1)

                ->orderBy('students.surname')
                ->paginate(config('paginate.studentsList'))->withQueryString();

            return [
                'faculties' => $faculties,
                'decrees' => $decrees,
                'students' => $students,
            ];
        }

        return ['faculties' => $faculties];
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @return void|object
     */
    public function changeEnrollmentStatus(Request $request)
    {
        if (is_null($request['decree_id'])) $request['faculty_id'] = null; // Если decree_id отсутствует, тогда обнуляем faculty_id.

        $isBudget = $this->budgetCheck($request);

        try {
            DB::transaction(function () use ($request, $isBudget) {

                $this->enrollment->where('student_id', $request['student_id'])->update([
                    'faculty_id' => $request['faculty_id'],
                    'decree_id' => $request['decree_id'],
                    'is_budget' => $isBudget,
                ]);

            }, 3);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @return bool
     */
    private function budgetCheck(Request $request): bool
    {
        $isBudget = false;

        $this->student = $this->student->find($request['student_id']);
        $facultyWithFinancingBudget = $this->student->facultiesPivotFinancing($request['faculty_id'])->get();

        if (!is_null($request['decree_id']) && $facultyWithFinancingBudget->isNotEmpty()) {
            $isBudget = true;
        }

        return $isBudget;
    }
}
