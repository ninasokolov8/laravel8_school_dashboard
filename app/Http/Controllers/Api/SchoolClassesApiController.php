<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreSchoolClassRequest;
	use App\Http\Requests\UpdateSchoolClassRequest;
	use App\Http\Resources\SchoolClassResource;
	use App\Models\SchoolClass;
	use Symfony\Component\HttpFoundation\Response;
	
	class SchoolClassesApiController extends Controller {
		public function index() {
			return new SchoolClassResource(SchoolClass::all());
		}
		
		public function store(StoreSchoolClassRequest $request) {
			$schoolClass = SchoolClass::create($request->all());
			return (new SchoolClassResource($schoolClass))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		
		public function show(SchoolClass $schoolClass) {
			return new SchoolClassResource($schoolClass);
		}
		
		public function update(UpdateSchoolClassRequest $request, SchoolClass $schoolClass) {
			$schoolClass->update($request->all());
			return (new SchoolClassResource($schoolClass))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		
		public function destroy(SchoolClass $schoolClass) {
			$schoolClass->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
