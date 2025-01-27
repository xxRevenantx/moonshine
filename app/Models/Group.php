<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['group', 'grade_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }


}
