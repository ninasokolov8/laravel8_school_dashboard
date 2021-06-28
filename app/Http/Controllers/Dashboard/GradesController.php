<?php
	
	namespace App\Http\Controllers\Dashboard;
	
	use App\Models\Grade;
	use App\Http\Controllers\Controller;
	use App\Http\Requests\MassDestroyGradeRequest;
	use App\Http\Requests\StoreGradeRequest;
	use App\Http\Requests\UpdateGradeRequest;
	use App\Models\Lesson;
	use App\Models\SchoolClass;
	use App\Models\User;
	use Illuminate\Support\Facades\Gate;
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
			$classes = SchoolClass::with(['classLessons','classUsers'])->get();
			return view('dashboard.grades.create', compact('classes','weekDays'));
		}
		
		public function store(StoreGradeRequest $request) {
			$tmp = explode('_',$request['lesson_id']);
			$dataToSave=[];
			if(!empty((int)$tmp[1]) && !empty((int)$tmp[1])){
				$dataToSave = [
					'user_id' =>(int)$request['user_id'],
					'teacher_id' =>(int)$tmp[1],
					'lesson_id' =>(int)$tmp[0],
					'class_id' =>(int)$request['class_id'],
					'grade' =>(int)$request['grade'],
				];
			}
			
			Grade::create($dataToSave);
			
			return redirect()->route('dashboard.grades.index');
		}
		
		public function edit(Grade $grade) {
			abort_if(Gate::denies('lesson_grade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$weekDays = Lesson::WEEK_DAYS;
			$grade->load('students', 'lessons','teachers','classes');
			
			
			return view('dashboard.grades.edit', compact('grade', 'weekDays'));
		}
		
		public function update(UpdateGradeRequest $request, Grade $grade) {
			$grade->update($request->all());
			
			return redirect()->route('dashboard.grades.index');
		}
		
		public function show(Grade $grade) {
			abort_if(Gate::denies('lesson_grade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			$weekDays = Lesson::WEEK_DAYS;
			$grade->load('students', 'lessons','teachers','classes');
			return view('dashboard.grades.show', compact('grade','weekDays'));
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
