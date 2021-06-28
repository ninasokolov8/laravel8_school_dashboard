<?php
	
	use App\Models\User;
	use Illuminate\Database\Seeder;
	
	class UsersTableSeeder extends Seeder {
		public function run() {
			$users = [
				[
					'id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				],
				
				//teachers
				
				[
					'id' => 2, 'name' => 'Adel - Art', 'email' => 'art@teacher.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				], [
					'id' => 3, 'name' => 'Moshe - Biology', 'email' => 'biology@teacher.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				], [
					'id' => 4, 'name' => 'Roni - Sport', 'email' => 'sport@teacher.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				], [
					'id' => 5, 'name' => 'Michal - Science', 'email' => 'science@teacher.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				], [
					'id' => 6, 'name' => 'Yossi - Math', 'email' => 'math@teacher.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				],	[
					'id' => 7, 'name' => 'Nurit - Art', 'email' => 'art2@teacher.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				], [
					'id' => 8, 'name' => 'Barak - Tech', 'email' => 'tech@teacher.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				], [
					'id' => 9, 'name' => 'Olga - Language', 'email' => 'language@teacher.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				], [
					'id' => 10, 'name' => 'Lilach - Swimming', 'email' => 'swimming@teacher.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				], [
					'id' => 11, 'name' => 'Tzuf - Math', 'email' => 'math2@teacher.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				], [
					'id' => 12, 'name' => 'Avihai - Science', 'email' => 'science2@teacher.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => null,
				],
				
				
				
				//students
				
				
				[
					'id' => 13, 'name' => 'Ravit - Student', 'email' => 'ravit@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 4,
				], [
					'id' => 14, 'name' => 'Avi - Student', 'email' => 'avi@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 1,
				], [
					'id' => 15, 'name' => 'Avner - Student', 'email' => 'avner@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 2,
				], [
					'id' => 16, 'name' => 'Yoav - Student', 'email' => 'yoav@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 1,
				], [
					'id' => 17, 'name' => 'Hana - Student', 'email' => 'Hana@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 7,
				], [
					'id' => 18, 'name' => 'Nilli - Student', 'email' => 'Nilli@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 11,
				], [
					'id' => 19, 'name' => 'Kobi - Student', 'email' => 'Kobi@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 11,
				], [
					'id' => 20, 'name' => 'Jordan - Student', 'email' => 'Jordan@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 11,
				], [
					'id' => 21, 'name' => 'Natali - Student', 'email' => 'Natali@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 10,
				], [
					'id' => 22, 'name' => 'Luka - Student', 'email' => 'Luka@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 9,
				], [
					'id' => 23, 'name' => 'Diana - Student', 'email' => 'Diana@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 2,
				], [
					'id' => 24, 'name' => 'Ido - Student', 'email' => 'Ido@student.com',
					'password' => '$2y$10$HvSDJRBDVWwRd18qj5oaQOF0DBXqnZcyFJ4dJA8hcQGAfmyZ7xkei',
					'remember_token' => null, 'class_id' => 2,
				],
			];
			
			User::insert($users);
		}
	}
