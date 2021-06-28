<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreLessonRequest;
	use App\Http\Requests\UpdateLessonRequest;
	use App\Http\Resources\LessonResource;
	use App\Models\Lesson;
	use Symfony\Component\HttpFoundation\Response;
	
	class LessonsApiController extends Controller {
		public function index() {
			return new LessonResource(Lesson::with([
				'class', 'teacher', 'class.classUsers', 'grades.students', 'grades'
			])->get());
		}
		
		public function store(StoreLessonRequest $request) {
			$lesson = Lesson::create($request->all());
			return (new LessonResource($lesson))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		
		public function show(Lesson $lesson) {
			return new LessonResource($lesson->load([
				'class', 'teacher', 'class.classUsers', 'grades.students', 'grades'
			]));
		}
		
		public function update(UpdateLessonRequest $request, Lesson $lesson) {
			$lesson->update($request->all());
			return (new LessonResource($lesson))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		
		public function destroy(Lesson $lesson) {
			$lesson->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
