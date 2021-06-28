<?php
	
	use App\Models\Role;
	use Illuminate\Database\Seeder;
	
	class RoleUserTableSeeder extends Seeder {
		public function run() {
			Role::findOrFail(1)->rolesUsers()->sync(1);
			Role::findOrFail(3)->rolesUsers()->sync([2, 3, 4, 5, 6,7,8,9,10,11,12]);
			Role::findOrFail(4)->rolesUsers()->sync([13,14,15,16,17,18,19,20,21,22,23,24]);
		}
	}
