<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\SoftDeletes;
	
	class Role extends BaseModel {
		use SoftDeletes;
		
		public $table = 'roles';
		const WITHRELATIONSGHIP =[
			'rolesUsers','permissions'
		];
		protected $dates = [
			'created_at', 'updated_at', 'deleted_at',
		];
		
		protected $fillable = [
			'title', 'created_at', 'updated_at', 'deleted_at',
		];
		
		public function rolesUsers() {
			return $this->belongsToMany(User::class);
		}
		
		public function permissions() {
			return $this->belongsToMany(Permission::class);
		}
	}
