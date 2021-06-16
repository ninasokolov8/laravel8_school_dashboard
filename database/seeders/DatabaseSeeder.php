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
         \DB::table('users')->insert([[
            'id'=>1,
            'username' => 'admin',
            'password' => bcrypt('1234'),
            'fullname' => 'admin user',
            'email' => 'admin@admin.com'
        ],
             [
                 'id'=>2,
                 'username' => 'biology teacher',
                 'password' => bcrypt('1234'),
                 'fullname' => 'biology teacher',
                 'email' => 'biology_teacher@teacher.com'
             ],
             [
                 'id'=>3,
                 'username' => 'english teacher',
                 'password' => bcrypt('1234'),
                 'fullname' => 'english teacher',
                 'email' => 'english_teacher@teacher.com'
             ],
             [
                 'id'=>4,
                 'username' => 'art teacher',
                 'password' => bcrypt('1234'),
                 'fullname' => 'art teacher',
                 'email' => 'art_teacher@teacher.com'
             ],
             [
                 'id'=>5,
                 'username' => 'student - avi',
                 'password' => bcrypt('1234'),
                 'fullname' => 'student - avi',
                 'email' => 'avi@student.com'
             ],
             [
                 'id'=>6,
                 'username' => 'student - nir',
                 'password' => bcrypt('1234'),
                 'fullname' => 'student - nir',
                 'email' => 'nir@student.com'
             ],
             [
                 'id'=>7,
                 'username' => 'student - neta',
                 'password' => bcrypt('1234'),
                 'fullname' => 'student - neta',
                 'email' => 'neta@student.com'
             ]]);

         \DB::table('roles')->insert([
            ['id'=>1,'name' => 'ROLE_ADMIN','description'=>'admin'],
            ['id'=>2,'name' => 'ROLE_STUDENT','description'=>'student'],
            ['id'=>3,'name' => 'ROLE_TEACHER','description'=>'teacher'],
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

    }
}
