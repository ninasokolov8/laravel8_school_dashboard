<?php

use App\Grade;
use Illuminate\Database\Seeder;

class GradeUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            [
                'user_id' => 8,
                'teacher_id' => 5,
                'lesson_id' => 1,
                'grade' => 96,
            ],
        ];

        Grade::insert($grades);
    }
}
