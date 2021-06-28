<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\SoftDeletes;
	
	/**
	 *
	 * @OA\Schema(
	 * @OA\Xml(name="Roles"),
	 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
	 * @OA\Property(property="title", type="string", example="some role"),
	 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
	 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at"),
	 * @OA\Property(property="deleted_at", ref="#/components/schemas/BaseModel/properties/deleted_at")
	 * )
	 *
	 * Class Role
	 *
	 */
	class Role extends BaseModel {
		use SoftDeletes;
		
		const WITHRELATIONSGHIP = [
			'rolesUsers', 'permissions'
		];
		public $table = 'roles';
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
