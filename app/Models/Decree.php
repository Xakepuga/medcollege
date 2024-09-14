<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decree extends Model
{
    use HasFactory;

    protected $table = 'decrees';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function enrollment()
    {
        return $this->hasMany(
            Enrollment::class,
            'decree_id',
            'id'
        );
    }
}
