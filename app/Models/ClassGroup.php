<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassGroup extends Model
{
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
