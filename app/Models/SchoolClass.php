<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\SoftDeletes;
	
	/**
	 *
	 * @OA\Schema(
	 * @OA\Xml(name="SchoolClasses"),
	 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
	 * @OA\Property(property="name", type="string", example="some class name"),
	 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
	 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at"),
	 * @OA\Property(property="deleted_at", ref="#/components/schemas/BaseModel/properties/deleted_at")
	 * )
	 *
	 * Class SchoolClass
	 *
	 */
	class SchoolClass extends BaseModel {
		use SoftDeletes;
		
		const WITHRELATIONSGHIP = [
			'classLessons', 'classUsers'
		];
		public $table = 'school_classes';
		
		protected $dates = [
			'created_at', 'updated_at', 'deleted_at',
		];
		
		protected $fillable = [
			'name', 'created_at', 'updated_at', 'deleted_at',
		];
		
		public function classLessons() {
			return $this->hasMany(Lesson::class, 'class_id', 'id');
		}
		
		public function classUsers() {
			return $this->hasMany(User::class, 'class_id', 'id');
		}
	}
