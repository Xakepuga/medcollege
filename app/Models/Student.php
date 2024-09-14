<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'passport_id',
        'phone',
        'email',
        'language_id',
        'about_me',
    ];

    public function passport()
    {
        return $this->belongsTo(
            Passport::class,
            'passport_id',
            'id'
        );
    }

    public function language()
    {
        return $this->belongsTo(
            Language::class,
            'language_id',
            'id'
        );
    }

    public function educational()
    {
        return $this->hasOne(
            Educational::class,
            'student_id',
            'id'
        );
    }

    public function seniority()
    {
        return $this->hasOne(
            Seniority::class,
            'student_id',
            'id'
        );
    }

    public function studentsParentFather()
    {
        return $this->hasOne(
            StudentsParentFather::class,
            'student_id',
            'id'
        );
    }

    public function studentsParentMother()
    {
        return $this->hasOne(
            StudentsParentMother::class,
            'student_id',
            'id'
        );
    }

    public function specialCircumstances()
    {
        return $this->belongsToMany(
            SpecialCircumstance::class,
            'student_special_circumstance',
            'student_id',
            'special_circumstance_id'
        )->withPivot('status');
    }

    public function faculties()
    {
        return $this->belongsToMany(
            Faculty::class,
            'information_for_admission',
            'student_id',
            'faculty_id'
        )->withPivot('is_original_docs', 'financing_type_id', 'testing');
    }

    /**
     * @param $id
     * @return BelongsToMany
     */
    public function facultiesPivotFinancing($id): BelongsToMany
    {
        return $this->belongsToMany(
            Faculty::class,
            'information_for_admission',
            'student_id',
            'faculty_id',
        )
            ->wherePivot('faculty_id', '=', $id)
            ->wherePivot('financing_type_id', '=', 1);
    }

    public function financingTypes()
    {
        return $this->belongsToMany(
            FinancingType::class,
            'information_for_admission',
            'student_id',
            'financing_type_id'
        )->withPivot('is_original_docs', 'faculty_id', 'testing');
    }

    public function enrollment()
    {
        return $this->hasOne(
            Enrollment::class,
            'student_id',
            'id'
        );
    }

    /**
     * @return HasOne
     */
    public function pensionInsurance(): HasOne
    {
        return $this->hasOne(
            PensionInsurance::class,
            'student_id',
            'id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'students_users',
            'student_id',
            'user_id'
        );
    }

    public function updateInformationForAdmissionTable($validatedData, $student)
    {
        $student = $this->find($student->id);

        $student->faculties()->detach();

        $admissionInfo = $validatedData['data'];

        foreach ($admissionInfo as $blockName => $blockContent) {
            $student->faculties()->attach($blockContent['faculty_id'], [
                    'student_id' => $student->id,
                    'financing_type_id' => $blockContent['financing_type_id'],
                    'is_original_docs' => $blockContent['is_original_docs'],
                    'testing' => $blockContent['testing']
                ]
            );
        }
    }

    public function updateStudentSpecialCircumstanceTable($validatedData, $student)
    {
        $student = $this->find($student->id);

        $student->specialCircumstances()->detach();

        $specialCircumstance = $validatedData['circumstance'];

        foreach ($specialCircumstance as $circumstanceId => $circumstanceValue) {
            $student->specialCircumstances()->attach($circumstanceId, [
                    'student_id' => $student->id,
                    'status' => $circumstanceValue,
                ]
            );
        }
    }
}
