<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StorePermissionRequest;
	use App\Http\Requests\UpdatePermissionRequest;
	use App\Http\Resources\PermissionResource;
	use App\Models\Permission;
	use Symfony\Component\HttpFoundation\Response;
	
	class PermissionsApiController extends Controller {
		public function index() {
			return new PermissionResource(Permission::all());
		}
		
		public function store(StorePermissionRequest $request) {
			$permission = Permission::create($request->all());
			return (new PermissionResource($permission))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		
		public function show(Permission $permission) {
			return new PermissionResource($permission);
		}
		
		public function update(UpdatePermissionRequest $request, Permission $permission) {
			$permission->update($request->all());
			return (new PermissionResource($permission))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		
		public function destroy(Permission $permission) {
			$permission->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
