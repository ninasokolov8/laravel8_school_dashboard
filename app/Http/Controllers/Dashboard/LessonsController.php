<?php
	
	namespace App\Http\Controllers\Dashboard;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\MassDestroyLessonRequest;
	use App\Http\Requests\StoreLessonRequest;
	use App\Http\Requests\UpdateLessonRequest;
	use App\Models\Lesson;
	use App\Models\SchoolClass;
	use App\Models\User;
	use Illuminate\Support\Facades\Gate;
	use Symfony\Component\HttpFoundation\Response;
	
	class LessonsController extends Controller {
		public function index() {
			abort_if(Gate::denies('lesson_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			$lessons = Lesson::all();
			return view('dashboard.lessons.index', compact('lessons'));
		}
		
		public function create() {
			abort_if(Gate::denies('lesson_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			$classes = SchoolClass::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
			$teachers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
			return view('dashboard.lessons.create', compact('classes', 'teachers'));
		}
		
		public function store(StoreLessonRequest $request) {
			Lesson::create($request->all());
			return redirect()->route('dashboard.lessons.index');
		}
		
		public function edit(Lesson $lesson) {
			abort_if(Gate::denies('lesson_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			$classes = SchoolClass::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
			$teachers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
			$lesson->load('class', 'teacher');
			return view('dashboard.lessons.edit', compact('classes', 'teachers', 'lesson'));
		}
		
		public function update(UpdateLessonRequest $request, Lesson $lesson) {
			$lesson->update($request->all());
			return redirect()->route('dashboard.lessons.index');
		}
		
		public function show(Lesson $lesson) {
			abort_if(Gate::denies('lesson_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			$lesson->load('class', 'teacher', 'class.classUsers');
			return view('dashboard.lessons.show', compact('lesson'));
		}
		
		public function destroy(Lesson $lesson) {
			abort_if(Gate::denies('lesson_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			$lesson->delete();
			return back();
		}
		
		public function massDestroy(MassDestroyLessonRequest $request) {
			Lesson::whereIn('id', request('ids'))->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
