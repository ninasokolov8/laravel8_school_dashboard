<?php
	
	namespace App\Models;
	
	use Carbon\Carbon;
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\SoftDeletes;
	
	class Lesson extends Model {
		use SoftDeletes, HasFactory;
		
		const WEEK_DAYS = [
			'1' => 'Sunday', '2' => 'Monday', '3' => 'Tuesday', '4' => 'Wednesday', '5' => 'Thursday', '6' => 'Friday',
			'7' => 'Saturday',
		];
		public $table = 'lessons';
		protected $dates = [
			'created_at', 'updated_at', 'deleted_at',
		];
		protected $fillable = [
			'weekday', 'class_id', 'end_time', 'teacher_id', 'start_time', 'created_at', 'updated_at', 'deleted_at',
		];
		
		public static function isTimeAvailable($weekday, $startTime, $endTime, $class, $teacher, $lesson) {
			$lessons = self::where('weekday', $weekday)->when($lesson, function ($query) use ($lesson) {
					$query->where('id', '!=', $lesson);
				})->where(function ($query) use ($class, $teacher) {
					$query->where('class_id', $class)->orWhere('teacher_id', $teacher);
				})->where([
					['start_time', '<', $endTime], ['end_time', '>', $startTime],
				])->count();
			
			return !$lessons;
		}
		
		public function getDifferenceAttribute() {
			return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
		}
		
		public function getStartTimeAttribute($value) {
			return $value ? Carbon::createFromFormat('H:i:s',
				$value)->format(config('panel.lesson_time_format')) : null;
		}
		
		public function setStartTimeAttribute($value) {
			$this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.lesson_time_format'),
				$value)->format('H:i:s') : null;
		}
		
		public function getEndTimeAttribute($value) {
			return $value ? Carbon::createFromFormat('H:i:s',
				$value)->format(config('panel.lesson_time_format')) : null;
		}
		
		public function setEndTimeAttribute($value) {
			$this->attributes['end_time'] = $value ? Carbon::createFromFormat(config('panel.lesson_time_format'),
				$value)->format('H:i:s') : null;
		}
		
		function class() {
			return $this->belongsTo(SchoolClass::class, 'class_id');
		}
		
		public function teacher() {
			return $this->belongsTo(User::class, 'teacher_id');
		}
		
		public function scopeCalendarByRoleOrClassId($query) {
			return $query->when(!request()->input('class_id'), function ($query) {
				$query->when(auth()->user()->is_teacher, function ($query) {
					$query->where('teacher_id', auth()->user()->id);
				})->when(auth()->user()->is_student, function ($query) {
						$query->where('class_id', auth()->user()->class_id ?? '0');
					});
			})->when(request()->input('class_id'), function ($query) {
					$query->where('class_id', request()->input('class_id'));
				});
		}
		
		function grades() {
			$this->belongsToMany(Grade::class, 'grade_user', 'lesson_id', 'user_id');
		}
	}
