<?php
	
	
	namespace App\Http\Controllers\Api;
	
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreUserRequest;
	use App\Http\Requests\UpdateUserRequest;
	use App\Http\Resources\UserResource;
	use App\Models\User;
	use Symfony\Component\HttpFoundation\Response;
	
	class UsersApiController extends Controller {
		public function index() {
			return new UserResource(User::with(['roles', 'class'])->get());
		}
		
		public function store(StoreUserRequest $request) {
			$user = User::create($request->all());
			$user->roles()->sync($request->input('roles', []));
			return (new UserResource($user))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		
		public function show(User $user) {
			return new UserResource($user->load(['roles', 'class']));
		}
		
		public function update(UpdateUserRequest $request, User $user) {
			$user->update($request->all());
			$user->roles()->sync($request->input('roles', []));
			return (new UserResource($user))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		
		public function destroy(User $user) {
			$user->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
