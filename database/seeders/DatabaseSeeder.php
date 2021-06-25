<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('school_classes')->insert([
            [
                'id' => 1,
                'name' => 'Mathematics'
            ],
            [
                'id' => 2,
                'name' => 'Biology'
            ],
            [
                'id' => 3,
                'name' => 'Art'
            ]
        ]);
         \DB::table('users')->insert([[
            'id'=>1,
            'username' => 'admin',
            'password' => bcrypt('1234'),
            'fullname' => 'admin user',
            'email' => 'admin@admin.com',
             'class_id'       => null,
        ],
             [
                 'id'=>2,
                 'username' => 'biology teacher',
                 'password' => bcrypt('1234'),
                 'fullname' => 'biology teacher',
                 'email' => 'biology_teacher@teacher.com',
                 'class_id'       => null,
             ],
             [
                 'id'=>3,
                 'username' => 'english teacher',
                 'password' => bcrypt('1234'),
                 'fullname' => 'english teacher',
                 'email' => 'english_teacher@teacher.com',
                 'class_id'       => null,
             ],
             [
                 'id'=>4,
                 'username' => 'art teacher',
                 'password' => bcrypt('1234'),
                 'fullname' => 'art teacher',
                 'email' => 'art_teacher@teacher.com',
                 'class_id'       => null,
             ],
             [
                 'id'=>5,
                 'username' => 'student - avi',
                 'password' => bcrypt('1234'),
                 'fullname' => 'student - avi',
                 'email' => 'avi@student.com',
                 'class_id'       => 2,
             ],
             [
                 'id'=>6,
                 'username' => 'student - nir',
                 'password' => bcrypt('1234'),
                 'fullname' => 'student - nir',
                 'email' => 'nir@student.com',
                 'class_id'       => 1,
             ],
             [
                 'id'=>7,
                 'username' => 'student - neta',
                 'password' => bcrypt('1234'),
                 'fullname' => 'student - neta',
                 'email' => 'neta@student.com',
                 'class_id'       => 1,
             ]]);

         \DB::table('roles')->insert([
            ['id'=>1,'name' => 'ROLE_ADMIN','description'=>'admin'],
            ['id'=>2,'name' => 'ROLE_STUDENT','description'=>'student'],
            ['id'=>3,'name' => 'ROLE_TEACHER','description'=>'teacher'],
              ]);

        \DB::table('lessons')->insert([
            [
                'id'         => 1,
                'teacher_id' => 2,
                'class_id'   => 2,
                'weekday'    => 1,
                'start_time' => '10:00',
                'end_time'   => '12:00',
            ],
            [
                'id'         => 2,
                'teacher_id' => 3,
                'class_id'   => 1,
                'weekday'    => 1,
                'start_time' => '12:00',
                'end_time'   => '14:00',
            ],
            [
                'id'         => 3,
                'teacher_id' => 4,
                'class_id'   => 3,
                'weekday'    => 1,
                'start_time' => '14:00',
                'end_time'   => '16:00',
            ],
            [
                'id'         => 4,
                'teacher_id' => 2,
                'class_id'   => 2,
                'weekday'    => 1,
                'start_time' => '14:00',
                'end_time'   => '16:00',
            ],
            [
                'id'         => 5,
                'teacher_id' => 3,
                'class_id'   => 1,
                'weekday'    => 2,
                'start_time' => '08:00',
                'end_time'   => '10:00',
            ],
            [
                'id'         => 6,
                'teacher_id' => 3,
                'class_id'   => 1,
                'weekday'    => 2,
                'start_time' => '10:00',
                'end_time'   => '12:00',
            ],
            [
                'id'         => 7,
                'teacher_id' => 4,
                'class_id'   => 3,
                'weekday'    => 2,
                'start_time' => '12:00',
                'end_time'   => '14:00',
            ],
            [
                'id'         => 8,
                'teacher_id' => 3,
                'class_id'   => 1,
                'weekday'    => 3,
                'start_time' => '10:00',
                'end_time'   => '12:00',
            ],
            [
                'id'         => 9,
                'teacher_id' => 2,
                'class_id'   => 2,
                'weekday'    => 3,
                'start_time' => '12:00',
                'end_time'   => '14:00',
            ],
            [
                'id'         => 10,
                'teacher_id' => 3,
                'class_id'   => 1,
                'weekday'    => 3,
                'start_time' => '14:00',
                'end_time'   => '16:00',
            ],
            [
                'id'         => 11,
                'teacher_id' => 4,
                'class_id'   => 3,
                'weekday'    => 4,
                'start_time' => '10:00',
                'end_time'   => '12:00',
            ],
            [
                'id'         => 12,
                'teacher_id' => 3,
                'class_id'   => 1,
                'weekday'    => 4,
                'start_time' => '12:00',
                'end_time'   => '14:00',
            ],
            [
                'id'         => 13,
                'teacher_id' => 4,
                'class_id'   => 3,
                'weekday'    => 4,
                'start_time' => '14:00',
                'end_time'   => '16:00',
            ],
            [
                'id'         => 14,
                'teacher_id' => 3,
                'class_id'   => 1,
                'weekday'    => 5,
                'start_time' => '08:00',
                'end_time'   => '10:00',
            ],
            [
                'id'         => 15,
                'teacher_id' => 2,
                'class_id'   => 2,
                'weekday'    => 5,
                'start_time' => '10:00',
                'end_time'   => '12:00',
            ],
            [
                'id'         => 16,
                'teacher_id' => 3,
                'class_id'   => 1,
                'weekday'    => 5,
                'start_time' => '12:00',
                'end_time'   => '14:00',
            ],
        ]);
         \DB::table('role_user')->insert([
            ['role_id' => 1,'user_id'=>1],
            ['role_id' => 3,'user_id'=>2],
            ['role_id' => 3,'user_id'=>3],
            ['role_id' => 3,'user_id'=>4],
            ['role_id' => 2,'user_id'=>5],
            ['role_id' => 2,'user_id'=>6],
            ['role_id' => 2,'user_id'=>7],

              ]);
        \DB::table('classes_to_teacher')->insert([
            ['class_id' => 1,'teacher_id'=>3],
            ['class_id' => 2,'teacher_id'=>2],
            ['class_id' => 3,'teacher_id'=>4]

        ]);

    }
}
