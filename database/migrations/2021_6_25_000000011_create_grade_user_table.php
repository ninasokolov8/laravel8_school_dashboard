<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	class CreateGradeUserTable extends Migration {
		public function up() {
			Schema::create('grade_user', function (Blueprint $table) {
				$table->increments('id');
				$table->unsignedInteger('user_id');
				$table->foreign('user_id', 'user_id_fk_1001498')->references('id')->on('users')->onDelete('cascade');
				$table->unsignedInteger('teacher_id');
				$table->foreign('teacher_id',
					'teacher_id_fk_1001499')->references('id')->on('users')->onDelete('cascade');
				$table->unsignedInteger('lesson_id');
				$table->foreign('lesson_id',
					'lesson_id_fk_1001499')->references('id')->on('lessons')->onDelete('cascade');
				$table->unsignedInteger('class_id');
				$table->foreign('class_id',
					'class_id_fk_1001500')->references('id')->on('school_classes')->onDelete('cascade');
				
				$table->unsignedInteger('grade')->nullable();
				$table->timestamps();
				$table->softDeletes();
				
			});
		}
	}
