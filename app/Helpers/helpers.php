<?php

use App\Models\Question;

if (! function_exists('question_type_label')) {
    function question_type_label(string $value): string
    {
        foreach (Question::QUESTION_TYPES as $type) {
            if ($type['value'] === $value) {
                return $type['name'];
            }
        }

        return ucfirst($value); // fallback if not found
    }
}
