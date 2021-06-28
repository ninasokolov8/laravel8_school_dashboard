<?php
	
	namespace App\Http\Requests;
	
	
	use Illuminate\Support\Facades\Gate;
	use Illuminate\Foundation\Http\FormRequest;
	use Symfony\Component\HttpFoundation\Response;
	
	class UpdateGradeRequest extends FormRequest {
		public function authorize() {
			abort_if(Gate::denies('lesson_grade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			return true;
		}
		
		public function rules() {
			return [
				 'grade' => [
					'required', 'integer'
				],
			
			];
		}
	}
