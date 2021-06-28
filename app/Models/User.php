<?php
	
	namespace App\Models;
	
	use Carbon\Carbon;
	use Hash;
	use Illuminate\Auth\Notifications\ResetPassword;
	use Illuminate\Contracts\Auth\MustVerifyEmail;
	use Illuminate\Database\Eloquent\SoftDeletes;
	use Illuminate\Foundation\Auth\User as Authenticatable;
	use Illuminate\Notifications\Notifiable;
	use Laravel\Passport\HasApiTokens;
	
	/**
	 *
	 * @OA\Schema(
	 * required={"password"},
	 * @OA\Xml(name="Users"),
	 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
	 * @OA\Property(property="name", type="string", readOnly="true", description="User role"),
	  * @OA\Property(property="email", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
	 * @OA\Property(property="password", type="string",  example="Jksndfj8sdyuvhsdifs8d9sdfohn"),
	 * @OA\Property(property="class_id", type="integer", maxLength=32, example="3"),
	 * @OA\Property(property="email_verified_at", type="string", readOnly="true", format="date-time", description="Datetime marker of verification status", example="2019-02-25 12:59:20"),
	 * @OA\Property(property="remember_token", type="string",  example="njsdjfbnj43rjnbwr2irbn"),
	 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
	 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at"),
	 * @OA\Property(property="deleted_at", ref="#/components/schemas/BaseModel/properties/deleted_at")
	 * )
	 *
	 * Class User
	 *
	 */
	class User extends Authenticatable {
		use SoftDeletes, Notifiable, HasApiTokens;
		
		const WITHRELATIONSGHIP = [
			'roles', 'grades', 'lessons', 'class'
		];
		public $table = 'users';
		protected $hidden = [
			'password', 'remember_token',
		];
		
		protected $dates = [
			'updated_at', 'created_at', 'deleted_at', 'email_verified_at',
		];
		
		protected $fillable = [
			'name', 'email', 'password', 'class_id', 'created_at', 'updated_at', 'deleted_at', 'remember_token',
			'email_verified_at',
		];
		
		public function getIsAdminAttribute() {
			return $this->roles()->where('id', 1)->exists();
		}
		
		public function roles() {
			return $this->belongsToMany(Role::class);
		}
		
		public function getIsTeacherAttribute() {
			return $this->roles()->where('id', 3)->exists();
		}
		
		public function getIsStudentAttribute() {
			return $this->roles()->where('id', 4)->exists();
		}
		
		public function teacherLessons() {
			return $this->hasMany(Lesson::class, 'teacher_id', 'id');
		}
		
		
		public function gradeLessons() {
			return $this->hasMany(Grade::class, 'user_id', 'id');
		}
		
		public function getEmailVerifiedAtAttribute($value) {
			return $value ? Carbon::createFromFormat('Y-m-d H:i:s',
				$value)->format(config('panel.date_format').' '.config('panel.time_format')) : null;
		}
		
		public function setEmailVerifiedAtAttribute($value) {
			$this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format').' '.config('panel.time_format'),
				$value)->format('Y-m-d H:i:s') : null;
		}
		
		public function setPasswordAttribute($input) {
			if ($input) {
				$this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
			}
		}
		
		public function sendPasswordResetNotification($token) {
			$this->notify(new ResetPassword($token));
		}
		
		function class() {
			return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
		}
		
		function lessons() {
			return $this->hasMany(Lesson::class, 'class_id', 'class_id');
		}
		
		function grades() {
			$this->belongsToMany(Grade::class, 'grade_user', 'user_id', 'lesson_id');
		}
	}
