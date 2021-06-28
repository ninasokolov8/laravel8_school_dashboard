<?php
	
	use App\Models\SchoolClass;
	use Illuminate\Database\Seeder;
	
	class SchoolClassesTableSeeder extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {
			$classes = [
				[
					'id' => 1, 'name' => 'Grade 1'
				], [
					'id' => 2, 'name' => 'Grade 2'
				], [
					'id' => 3, 'name' => 'Grade 3'
				], [
					'id' => 4, 'name' => 'Grade 4'
				], [
					'id' => 5, 'name' => 'Grade 5'
				], [
					'id' => 6, 'name' => 'Grade 6'
				], [
					'id' => 7, 'name' => 'Grade 7'
				], [
					'id' => 8, 'name' => 'Grade 8'
				], [
					'id' => 9, 'name' => 'Grade 9'
				], [
					'id' => 10, 'name' => 'Grade 10'
				], [
					'id' => 11, 'name' => 'Grade 11'
				], [
					'id' => 12, 'name' => 'Grade 12'
				]
			];
			
			SchoolClass::insert($classes);
		}
	}
