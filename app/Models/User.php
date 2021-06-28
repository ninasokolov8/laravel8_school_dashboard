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
	
	class User extends Authenticatable {
		use SoftDeletes, Notifiable, HasApiTokens;
		
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
		
		public static function getUsersByRole(){
			$return =[
				'teachers'=>[0=>['id'=>0,'name'=>trans('global.pleaseSelect')]],
				'students'=>[0=>['id'=>0,'name'=>trans('global.pleaseSelect')]],
			];
			$users = self::all();
			foreach ($users as $user){
				if($user->getIsTeacherAttribute())array_push($return['teachers'],$user->toArray());
				if($user->getIsStudentAttribute())array_push($return['students'],$user->toArray());
			}
			return $return;
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
			return $this->belongsTo(SchoolClass::class, 'class_id');
		}
		
		function lessons() {
			return $this->belongsTo(Lesson::class, 'class_id', 'class_id');
		}
		
		function grades() {
			$this->belongsToMany(Grade::class, 'grade_user', 'user_id', 'lesson_id');
		}
	}
