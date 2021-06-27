<?php
	
	namespace App\Http\Controllers\Dashboard;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\MassDestroySchoolClassRequest;
	use App\Http\Requests\StoreSchoolClassRequest;
	use App\Http\Requests\UpdateSchoolClassRequest;
	use App\Models\SchoolClass;
	use Illuminate\Support\Facades\Gate;
	use Symfony\Component\HttpFoundation\Response;
	
	class SchoolClassesController extends Controller {
		public function index() {
			abort_if(Gate::denies('school_class_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$schoolClasses = SchoolClass::all();
			
			return view('dashboard.schoolClasses.index', compact('schoolClasses'));
		}
		
		public function create() {
			abort_if(Gate::denies('school_class_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			return view('dashboard.schoolClasses.create');
		}
		
		public function store(StoreSchoolClassRequest $request) {
			$schoolClass = SchoolClass::create($request->all());
			
			return redirect()->route('dashboard.school-classes.index');
		}
		
		public function edit(SchoolClass $schoolClass) {
			abort_if(Gate::denies('school_class_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			return view('dashboard.schoolClasses.edit', compact('schoolClass'));
		}
		
		public function update(UpdateSchoolClassRequest $request, SchoolClass $schoolClass) {
			$schoolClass->update($request->all());
			
			return redirect()->route('dashboard.school-classes.index');
		}
		
		public function show(SchoolClass $schoolClass) {
			abort_if(Gate::denies('school_class_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$schoolClass->load('classLessons', 'classUsers', 'classLessons');
			
			return view('dashboard.schoolClasses.show', compact('schoolClass'));
		}
		
		public function destroy(SchoolClass $schoolClass) {
			abort_if(Gate::denies('school_class_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$schoolClass->delete();
			
			return back();
		}
		
		public function massDestroy(MassDestroySchoolClassRequest $request) {
			SchoolClass::whereIn('id', request('ids'))->delete();
			
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
