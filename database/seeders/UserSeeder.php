<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleLecturer = Role::where('name', 'Lecturer')->first();
        $roleStudent = Role::where('name', 'Student')->first();

        // Lecturer
        User::create([
            'name' => 'Mr. Abdullah',
            'email' => 'lecturer@example.com',
            'password' => Hash::make('password'),
            'role_id' => $roleLecturer->id,
        ]);

        $classA = ClassGroup::where('name', 'Class A')->first();
        $classB = ClassGroup::where('name', 'Class B')->first();

        // Students
        User::create([
            'name' => 'Ahmad (studenta1)',
            'email' => 'studenta1@example.com',
            'password' => Hash::make('password'),
            'role_id' => $roleStudent->id,
            'class_group_id' => $classA->id,
        ]);
        User::create([
            'name' => 'Akram (studenta2)',
            'email' => 'studenta2@example.com',
            'password' => Hash::make('password'),
            'role_id' => $roleStudent->id,
            'class_group_id' => $classA->id,
        ]);
        User::create([
            'name' => 'Bob (studentb1)',
            'email' => 'studentb1@example.com',
            'password' => Hash::make('password'),
            'role_id' => $roleStudent->id,
            'class_group_id' => $classB->id,
        ]);
        User::create([
            'name' => 'Badariah (studentb2)',
            'email' => 'studentb2@example.com',
            'password' => Hash::make('password'),
            'role_id' => $roleStudent->id,
            'class_group_id' => $classB->id,
        ]);
    }
}
