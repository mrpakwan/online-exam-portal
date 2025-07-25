<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $guarded = [];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getDurationLabelAttribute()
    {
        return gmdate('H:i', $this->duration * 60); // e.g. "01:30"
    }
}
