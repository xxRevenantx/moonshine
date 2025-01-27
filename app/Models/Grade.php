<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['grade', 'grade_number', 'level_id'];


    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function group()
    {
        return $this->hasMany(Group::class);
    }
}
