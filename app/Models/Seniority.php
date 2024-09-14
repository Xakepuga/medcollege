<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seniority extends Model
{
    use HasFactory;

    protected $table = 'seniority';

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'place_work',
        'profession',
        'years',
        'months',
    ];

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'id');
    }
}
