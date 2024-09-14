<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollment';

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'faculty_id',
        'decree_id',
        'is_budget',
        'is_pickup_docs',
    ];

    protected $with = ['faculty', 'decree'];

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'id'
        );
    }

    public function faculty()
    {
        return $this->belongsTo(
            Faculty::class,
            'faculty_id',
            'id'
        );
    }

    public function decree()
    {
        return $this->belongsTo(
            Decree::class,
            'decree_id',
            'id'
        );
    }
}
