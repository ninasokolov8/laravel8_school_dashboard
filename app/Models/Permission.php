<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\SoftDeletes;
	
	/**
	 *
	 * @OA\Schema(
	 * @OA\Xml(name="Permissions"),
	 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
	 * @OA\Property(property="title", type="string", example="some_permission"),
	 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
	 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at"),
	 * @OA\Property(property="deleted_at", ref="#/components/schemas/BaseModel/properties/deleted_at")
	 * )
	 *
	 * Class Permission
	 *
	 */
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
