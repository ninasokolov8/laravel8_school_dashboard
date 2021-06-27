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
					'id' => 1, 'name' => 'Building A Class 11'
				], [
					'id' => 2, 'name' => 'Building B Class 8'
				], [
					'id' => 3, 'name' => 'Building B Class 10'
				], [
					'id' => 4, 'name' => 'Building A Class 9'
				]
			];
			
			SchoolClass::insert($classes);
		}
	}
