<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Http\Resources\GradesResource;
	use App\Models\Grade;
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreGradeRequest;
	use App\Http\Requests\UpdateGradeRequest;
	use Symfony\Component\HttpFoundation\Response;
	
	class GradesApiController extends Controller {
		public function index() {
			return new GradesResource(Grade::with(['teachers', 'students', 'lessons'])->get());
		}
		
		public function store(StoreGradeRequest $request) {
			$grade = Grade::create($request->all());
			return (new GradesResource($grade))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		
		public function update(UpdateGradeRequest $request, Grade $grade) {
			$grade->update($request->all());
			return (new GradesResource($grade))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		
		public function show(Grade $grade) {
			return new GradesResource($grade->load('teachers', 'students', 'lessons'));
		}
		
		public function destroy(Grade $grade) {
			$grade->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
		
	}
