<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $guarded = [];

    public function classGroup()
    {
        return $this->belongsTo(ClassGroup::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
