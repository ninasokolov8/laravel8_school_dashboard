<?php
	
	namespace App\Http\Requests;
	
	use Illuminate\Support\Facades\Gate;
	use Illuminate\Foundation\Http\FormRequest;
	use Symfony\Component\HttpFoundation\Response;
	
	class MassDestroyGradeRequest extends FormRequest {
		public function authorize() {
			abort_if(Gate::denies('lesson_grade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			return true;
		}
		
		public function rules() {
			return [
				'ids' => 'required|array', 'ids.*' => 'exists:grade_user,id',
			];
		}
	}
