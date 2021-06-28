<?php
	
	namespace App\Http\Controllers\Dashboard;
	
	use App\Models\Grade;
	use App\Http\Controllers\Controller;
	use App\Http\Requests\MassDestroyGradeRequest;
	use App\Http\Requests\StoreGradeRequest;
	use App\Http\Requests\UpdateGradeRequest;
	use App\Models\Lesson;
	use App\Models\SchoolClass;
	use Illuminate\Support\Facades\Gate;
	use Illuminate\Support\Facades\Request;
	use Symfony\Component\HttpFoundation\Response;
	
	class GradesController extends Controller {
		public function index() {
			abort_if(Gate::denies('lesson_grade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			$grades = Grade::with(['teachers', 'students', 'lessons'])->get();
			return view('dashboard.grades.index', compact('grades'));
		}
		
		public function create() {
			abort_if(Gate::denies('lesson_grade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			$weekDays = Lesson::WEEK_DAYS;
			$classes = SchoolClass::with(['classLessons', 'classUsers'])->get();
			return view('dashboard.grades.create', compact('classes', 'weekDays'));
		}
		
		public function store(StoreGradeRequest $request) {
			Grade::create($request->all());
			return redirect()->route('dashboard.grades.index');
		}
		
		public function edit(Grade $grade) {
			abort_if(Gate::denies('lesson_grade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			$weekDays = Lesson::WEEK_DAYS;
			$grade->load('students', 'lessons', 'teachers', 'classes');
			return view('dashboard.grades.edit', compact('grade', 'weekDays'));
		}
		
		public function update(UpdateGradeRequest $request, Grade $grade) {
			$grade->update($request->all());
			return redirect()->route('dashboard.grades.index');
		}
		
		public function show(Grade $grade) {
			abort_if(Gate::denies('lesson_grade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			$weekDays = Lesson::WEEK_DAYS;
			$grade->load('students', 'lessons', 'teachers', 'classes');
			return view('dashboard.grades.show', compact('grade', 'weekDays'));
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
		
		//this is a dynamic function function that return data via filter
		//this function used in the "dashboard.grades.create" blade.
		// to create new grade, we need to make sure that the student is in a specific class and that he went to specific lesson.
		
		public function getbyfilter(Request $request) {
			$ModelClassName = 'App\\Models\\'.$request::get('m');
			$ModelResource = 'App\\Http\\Resources\\'.$request::get('m').'Resource';
			$withRelationships = $ModelClassName::WITHRELATIONSGHIP;
			return new $ModelResource($ModelClassName::where($request::get('param'),
				$request::get('val'))->with($withRelationships)->get());
			
			//example return - for the following request:
			//$request::get('m') = 'Lesson';
			//$request::get('param') = 'id';
			//$request::get('val') = 3;
			//$withRelationships = Lesson::WITHRELATIONSGHIP; // ['class','teacher'];
			//return new LessonResource(Lesson::where('id',3)->with(['class','teacher'])->get());
			
		}
	}
