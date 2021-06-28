<?php
	
	namespace App\Models;
	
	
	/**
	 *
	 * @OA\Schema(
	 * @OA\Xml(name="Grades"),
	 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
	 * @OA\Property(property="user_id", type="integer", example="5"),
	 * @OA\Property(property="teacher_id", type="integer", example="5"),
	 * @OA\Property(property="lesson_id", type="integer",  example="2"),
	 * @OA\Property(property="class_id", type="integer", maxLength=32, example="2"),
	 * @OA\Property(property="grade", type="integer", maxLength=32, example="100"),
	 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
	 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at"),
	 * @OA\Property(property="deleted_at", ref="#/components/schemas/BaseModel/properties/deleted_at")
	 * )
	 *
	 * Class Grades
	 *
	 */
	
	use Illuminate\Database\Eloquent\SoftDeletes;
	
	class Grade extends BaseModel {
		use SoftDeletes;
		
		const WITHRELATIONSGHIP = [
			'students', 'teachers', 'lessons', 'classes'
		];
		public $table = 'grade_user';
		
		protected $dates = [
			'created_at', 'updated_at', 'deleted_at',
		];
		
		protected $fillable = [
			'user_id', 'teacher_id', 'lesson_id', 'class_id', 'grade', 'created_at', 'updated_at', 'deleted_at',
		];
		
		public function students() {
			return $this->belongsTo(User::class, 'user_id', 'id');
		}
		
		public function teachers() {
			return $this->belongsTo(User::class, 'teacher_id', 'id');
		}
		
		public function lessons() {
			return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
		}
		
		public function classes() {
			return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
		}
	}
