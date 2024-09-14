<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingType extends Model
{
    use HasFactory;

    protected $table = 'financing_types';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'information_for_admission',
            'financing_type_id',
            'student_id'
        )->withPivot('is_original_docs', 'faculty_id');
    }

    public function faculties()
    {
        return $this->belongsToMany(
            Faculty::class,
            'information_for_admission',
            'financing_type_id',
            'faculty_id'
        )->withPivot('is_original_docs', 'student_id');
    }
}
