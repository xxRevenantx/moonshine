<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['grade', 'grade_number', 'level_id', 'generation_id'];


    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function generation()
    {
        return $this->belongsTo(Generation::class);
    }
}
