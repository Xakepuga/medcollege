<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalInstitutionType extends Model
{
    use HasFactory;

    protected $table = 'educational_institution_types';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function educational()
    {
        return $this->hasMany(
            Educational::class,
            'ed_institution_type_id',
            'id'
        );
    }
}
