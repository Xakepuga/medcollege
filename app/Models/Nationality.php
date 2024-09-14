<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

    protected $table = 'nationality';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function passports()
    {
        return $this->hasMany(
            Passport::class,
            'nationality_id',
            'id'
        );
    }
}
