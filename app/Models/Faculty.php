<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            Student::class,
            'information_for_admission',
            'faculty_id',
            'student_id'
        )->withPivot('is_original_docs', 'financing_type_id', 'testing');
    }

    /**
     * @param $id
     * @return BelongsToMany
     */
    public function studentsPivotFinancing($id): BelongsToMany
    {
        return $this->belongsToMany(
            Student::class,
            'information_for_admission',
            'faculty_id',
            'student_id'
        )->wherePivot('financing_type_id', '=', $id);
    }

    /**
     * @return BelongsToMany
     */
    public function financingTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            FinancingType::class,
            'information_for_admission',
            'faculty_id',
            'financing_type_id'
        )->withPivot('is_original_docs', 'faculty_id', 'testing');
    }

    /**
     * @return BelongsToMany
     */
    public function studentsPivotOrigDocs(): BelongsToMany
    {
        return $this->belongsToMany(
            Student::class,
            'information_for_admission',
            'faculty_id',
            'student_id'
        )->wherePivot('is_original_docs', '=', 1);
    }

    /**
     * @return HasMany
     */
    public function enrollment(): HasMany
    {
        return $this->hasMany(
            Enrollment::class,
            'faculty_id',
            'id'
        );
    }
}
