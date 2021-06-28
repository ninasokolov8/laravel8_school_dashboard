<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreRoleRequest;
	use App\Http\Requests\UpdateRoleRequest;
	use App\Http\Resources\RoleResource;
	use App\Models\Role;
	use Symfony\Component\HttpFoundation\Response;
	
	class RolesApiController extends Controller {
		public function index() {
			return new RoleResource(Role::with(['permissions', 'rolesUsers'])->get());
		}
		
		public function store(StoreRoleRequest $request) {
			$role = Role::create($request->all());
			$role->permissions()->sync($request->input('permissions', []));
			return (new RoleResource($role))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		
		public function show(Role $role) {
			return new RoleResource($role->load(['permissions', 'rolesUsers']));
		}
		
		public function update(UpdateRoleRequest $request, Role $role) {
			$role->update($request->all());
			$role->permissions()->sync($request->input('permissions', []));
			return (new RoleResource($role))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		
		public function destroy(Role $role) {
			$role->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
