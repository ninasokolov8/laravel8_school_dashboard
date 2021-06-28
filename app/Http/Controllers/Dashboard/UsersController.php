<?php
	
	namespace App\Http\Controllers\Dashboard;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\MassDestroyUserRequest;
	use App\Http\Requests\StoreUserRequest;
	use App\Http\Requests\UpdateUserRequest;
	use App\Models\Role;
	use App\Models\SchoolClass;
	use App\Models\User;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Gate;
	use Symfony\Component\HttpFoundation\Response;
	
	class UsersController extends Controller {
		public function index(Request $request) {
			abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$users = User::when($request->role, function ($query) use ($request) {
				$query->whereHas('roles', function ($query) use ($request) {
					$query->whereId($request->role);
				});
			})->get();
			
			return view('dashboard.users.index', compact('users'));
		}
		
		public function create() {
			abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$roles = Role::all()->pluck('title', 'id');
			
			$classes = SchoolClass::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
			
			return view('dashboard.users.create', compact('roles', 'classes'));
		}
		
		public function store(StoreUserRequest $request) {
			$user = User::create($request->all());
			$user->roles()->sync($request->input('roles', []));
			
			return redirect()->route('dashboard.users.index');
		}
		
		public function edit(User $user) {
			abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$roles = Role::all()->pluck('title', 'id');
			
			$classes = SchoolClass::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
			
			$user->load('roles', 'class');
			
			return view('dashboard.users.edit', compact('roles', 'classes', 'user'));
		}
		
		public function update(UpdateUserRequest $request, User $user) {
			$user->update($request->all());
			$user->roles()->sync($request->input('roles', []));
			
			return redirect()->route('dashboard.users.index');
		}
		
		public function show(User $user) {
			abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$user->load('roles', 'class', 'teacherLessons', 'gradeLessons', 'lessons','teacherLessons.class.classUsers');
			return view('dashboard.users.show', compact('user'));
		}
		
		public function destroy(User $user) {
			abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
			
			$user->delete();
			
			return back();
		}
		
		public function massDestroy(MassDestroyUserRequest $request) {
			User::whereIn('id', request('ids'))->delete();
			
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
