<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Models\Grade;
	use App\Http\Controllers\Controller;
	use App\Http\Requests\MassDestroyGradeRequest;
	use App\Http\Requests\StoreGradeRequest;
	use App\Http\Requests\UpdateGradeRequest;
	use App\Models\Lesson;
	use App\Models\User;
	use Illuminate\Support\Facades\Gate;
	use Symfony\Component\HttpFoundation\Response;
	
	class GradesApiController extends Controller {
		public function index() {
			abort_if(Gate::denies('lesson_grade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			
			$grades = Grade::with(['teachers', 'students', 'lessons'])->get();
			return view('dashboard.grades.index', compact('grades'));
		}
		
		public function create() {
			abort_if(Gate::denies('lesson_grade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
			
			$lessons = Lesson::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
			
			return view('dashboard.grades.create', compact('users', 'lessons'));
		}
		
		public function store(StoreGradeRequest $request) {
			$grade = Grade::create($request->all());
			
			return redirect()->route('dashboard.grades.index');
		}
		
		public function edit(Grade $lesson) {
			abort_if(Gate::denies('lesson_grade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
			
			$lessons = Lesson::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
			
			
			return view('dashboard.grades.edit', compact('users', 'lessons'));
		}
		
		public function update(UpdateGradeRequest $request, Grade $grade) {
			$grade->update($request->all());
			
			return redirect()->route('dashboard.grade.index');
		}
		
		public function show(Grade $greade) {
			abort_if(Gate::denies('lesson_grade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$greade->load('gradeUsers', 'gradeLessons');
			
			return view('dashboard.lessons.show', compact('greade'));
		}
		
		public function destroy(Grade $grade) {
			abort_if(Gate::denies('lesson_grade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$grade->delete();
			
			return back();
		}
		
		public function massDestroy(MassDestroyGradeRequest $request) {
			Grade::whereIn('id', request('ids'))->delete();
			
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
