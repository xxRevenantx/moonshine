<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use HasFactory;


    protected $fillable = [
        'generation',
        'start_year',
        'end_year',
        'status',

    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

}
