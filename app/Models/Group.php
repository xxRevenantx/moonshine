<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['group', 'grade_id', 'level_id', 'generation_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function generation()
    {
        return $this->belongsTo(Generation::class);
    }




}
