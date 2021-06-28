<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\SoftDeletes;
	
	class Permission extends BaseModel {
		use SoftDeletes;
		const WITHRELATIONSGHIP =[
			'permissionsRoles'
		];
		public $table = 'permissions';
		
		protected $dates = [
			'created_at', 'updated_at', 'deleted_at',
		];
		
		protected $fillable = [
			'title', 'created_at', 'updated_at', 'deleted_at',
		];
		
		public function permissionsRoles() {
			return $this->belongsToMany(Role::class);
		}
	}
