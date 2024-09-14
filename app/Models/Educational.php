<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educational extends Model
{
    use HasFactory;

    protected $table = 'educational';

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'ed_institution_type_id',
        'ed_doc_type_id',
        'ed_doc_number',
        'ed_institution_name',
        'is_first_spo',
        'is_excellent_student',
        'avg_rating',
        'issue_date',
    ];

    protected $with = ['educationalInstitutionType', 'educationalDocType'];

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'id'
        );
    }

    public function educationalInstitutionType()
    {
        return $this->belongsTo(
            EducationalInstitutionType::class,
            'ed_institution_type_id',
            'id'
        );
    }

    public function educationalDocType()
    {
        return $this->belongsTo(
            EducationalDocType::class,
            'ed_doc_type_id',
            'id'
        );
    }
}
