<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use HasFactory;

    protected $table = 'passports';

    public $timestamps = false;

    protected $fillable = [
        'birthday',
        'birthplace',
        'number',
        'gender',
        'nationality_id',
        'issue_by',
        'issue_date',
        'address_registered',
        'address_residential',
    ];

    protected $with = ['nationality'];

    public function student()
    {
        return $this->hasOne(
            Student::class,
            'passport_id',
            'id'
        );
    }

    public function nationality()
    {
        return $this->belongsTo(
            Nationality::class,
            'nationality_id',
            'id'
        );
    }
}
