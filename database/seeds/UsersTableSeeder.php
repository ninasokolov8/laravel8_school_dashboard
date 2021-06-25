<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
                'remember_token' => null,
                'class_id'       => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Adel - Art',
                'email'          => 'art@teacher.com',
                'password'       => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
                'remember_token' => null,
                'class_id'       => null,
            ],
            [
                'id'             => 3,
                'name'           => 'Moshe - Biology',
                'email'          => 'biology@teacher.com',
                'password'       => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
                'remember_token' => null,
                'class_id'       => null,
            ],
            [
                'id'             => 4,
                'name'           => 'Roni - Sport',
                'email'          => 'sport@teacher.com',
                'password'       => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
                'remember_token' => null,
                'class_id'       => null,
            ],
            [
                'id'             => 5,
                'name'           => 'Michal - Science',
                'email'          => 'science@teacher.com',
                'password'       => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
                'remember_token' => null,
                'class_id'       => null,
            ],
            [
                'id'             => 6,
                'name'           => 'Yossi - Math',
                'email'          => 'math@teacher.com',
                'password'       => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
                'remember_token' => null,
                'class_id'       => null,
            ],
            [
                'id'             => 7,
                'name'           => 'Ravit - Student',
                'email'          => 'ravit@student.com',
                'password'       => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
                'remember_token' => null,
                'class_id'       => 4,
            ],
            [
                'id'             => 8,
                'name'           => 'Avi - Student',
                'email'          => 'avi@student.com',
                'password'       => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
                'remember_token' => null,
                'class_id'       => 1,
            ],
            [
                'id'             => 9,
                'name'           => 'Avner - Student',
                'email'          => 'avner@student.com',
                'password'       => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
                'remember_token' => null,
                'class_id'       => 2,
            ],
        ];

        User::insert($users);
    }
}
