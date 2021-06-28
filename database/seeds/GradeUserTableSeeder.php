<?php
	
	use App\Models\Grade;
	use Illuminate\Database\Seeder;
	
	class GradeUserTableSeeder extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {
			$grades = [
				[
					'user_id' => 13, 'teacher_id' => 4, 'lesson_id' => 4, 'grade' => 96, 'class_id'=>4
				],
			];
			
			Grade::insert($grades);
		}
	}
