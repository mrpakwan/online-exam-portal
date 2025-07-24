<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $guarded = [];

    const QUESTION_TYPE_MCQ_VALUE = 'mcq';

    const QUESTION_TYPE_OPEN_VALUE = 'open';

    const QUESTION_TYPE_MCQ_LABEL = 'Multiple Choice';

    const QUESTION_TYPE_OPEN_LABEL = 'Open Text';

    const QUESTION_TYPES = [
        [
            'value' => self::QUESTION_TYPE_MCQ_VALUE,
            'name' => self::QUESTION_TYPE_MCQ_LABEL,
        ],
        [
            'value' => self::QUESTION_TYPE_OPEN_VALUE,
            'name' => self::QUESTION_TYPE_OPEN_LABEL,
        ],
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
