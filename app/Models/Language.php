<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function students()
    {
        return $this->hasMany(
            Student::class,
            'language_id',
            'id'
        );
    }
}
