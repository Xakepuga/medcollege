<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialCircumstance extends Model
{
    use HasFactory;

    protected $table = 'special_circumstances';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'student_special_circumstance',
            'special_circumstance_id',
            'student_id'
        );
    }
}
