<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\SoftDeletes;
	
	class Grade extends Model {
		use SoftDeletes;
		
		public $table = 'grade_user';
		
		protected $dates = [
			'created_at', 'updated_at', 'deleted_at',
		];
		
		protected $fillable = [
			'user_id', 'teacher_id', 'grade', 'created_at', 'updated_at', 'deleted_at',
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
