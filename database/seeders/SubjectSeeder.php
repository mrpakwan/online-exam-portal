<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classA = ClassGroup::where('name', 'Class A')->first();
        $classB = ClassGroup::where('name', 'Class B')->first();

        Subject::create(['name' => 'Math', 'class_group_id' => $classA->id]);
        Subject::create(['name' => 'Science', 'class_group_id' => $classA->id]);
        Subject::create(['name' => 'History', 'class_group_id' => $classB->id]);
        Subject::create(['name' => 'Geography', 'class_group_id' => $classB->id]);
    }
}
