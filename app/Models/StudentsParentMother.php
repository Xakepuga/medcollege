<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsParentMother extends Model
{
    use HasFactory;

    protected $table = 'student_parent_mothers';

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'name',
        'surname',
        'patronymic',
        'phone',
    ];

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'id');
    }
}
