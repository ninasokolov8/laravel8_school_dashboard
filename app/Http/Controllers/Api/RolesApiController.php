<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreRoleRequest;
	use App\Http\Requests\UpdateRoleRequest;
	use App\Http\Resources\RoleResource;
	use App\Models\Role;
	use Symfony\Component\HttpFoundation\Response;
	
	class RolesApiController extends Controller {
		/**
		 * @OA\Get(
		 * path="/api/roles",
		 * tags={"Roles"},
		 * summary="Retrieve all roles information",
		 * description="Get permissions roles with their relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Role")
		 *        )
		 *     ),
		 * @OA\Response(
		 *    response=401,
		 *    description="Not authorized",
		 *    @OA\JsonContent(
		 *       @OA\Property(property="message", type="string", example="Not authorized"),
		 *    )
		 * )
		 * )
		 */
		public function index() {
			return new RoleResource(Role::with(['permissions', 'rolesUsers'])->get());
		}
		
		
		/**
		 * @OA\Post(
		 * path="/api/roles",
		 * tags={"Roles"},
		 * summary="save new roles information",
		 * description="Save roles information ",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\RequestBody(
		 *    required=true,
		 *    description="Pass roles data",
		 *    @OA\JsonContent(
		 *       required={"title","permissions.*","permissions"},
		 *       @OA\Property(property="title", type="string", format="title", example="this_is_new_permission"),
		 *       @OA\Property(property="permissions.*", type="int", format="permissions.*", example="1"),
		 *       @OA\Property(property="permissions", type="array string", format="permissions", example="[1,3]")
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Role")
		 *        )
		 *     ),
		 * @OA\Response(
		 *    response=401,
		 *    description="Not authorized",
		 *    @OA\JsonContent(
		 *       @OA\Property(property="message", type="string", example="Not authorized"),
		 *    )
		 * )
		 * )
		 */
		public function store(StoreRoleRequest $request) {
			$role = Role::create($request->all());
			$role->permissions()->sync($request->input('permissions', []));
			return (new RoleResource($role))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		
		/**
		 * @OA\Get(
		 * path="/api/roles/{id}",
		 *tags={"Roles"},
		 * summary="Retrieve specific role record information",
		 * description="Get role information with his relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Role")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the role record",
		 *    in="path",
		 *    name="id",
		 *    required=true,
		 *    example="1",
		 *    @OA\Schema(
		 *       type="integer",
		 *       format="int64"
		 *    )
		 * ),
		 * @OA\Response(
		 *    response=401,
		 *    description="Not authorized",
		 *    @OA\JsonContent(
		 *       @OA\Property(property="message", type="string", example="Not authorized"),
		 *    )
		 * )
		 * )
		 */
		public function show(Role $role) {
			return new RoleResource($role->load(['permissions', 'rolesUsers']));
		}
		
		/**
		 * @OA\Put(
		 * path="/api/roles/{id}",
		 * tags={"Roles"},
		 * summary="update role information",
		 * description="update role information ",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Parameter(
		 *    description="ID of the role record",
		 *    in="path",
		 *    name="id",
		 *    required=true,
		 *    example="1",
		 *    @OA\Schema(
		 *       type="integer",
		 *       format="int64"
		 *    )
		 * ),
		 * @OA\RequestBody(
		 *    required=true,
		 *    description="Pass role data",
		 *    @OA\JsonContent(
		 *      required={"title","permissions.*","permissions"},
		 *       @OA\Property(property="title", type="string", format="title", example="this_is_new_permission"),
		 *       @OA\Property(property="permissions.*", type="int", format="permissions.*", example="1"),
		 *       @OA\Property(property="permissions", type="array string", format="permissions", example="[1,3]")
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Role")
		 *        )
		 *     ),
		 * @OA\Response(
		 *    response=401,
		 *    description="Not authorized",
		 *    @OA\JsonContent(
		 *       @OA\Property(property="message", type="string", example="Not authorized"),
		 *    )
		 * )
		 * )
		 */
		public function update(UpdateRoleRequest $request, Role $role) {
			$role->update($request->all());
			$role->permissions()->sync($request->input('permissions', []));
			return (new RoleResource($role))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		
		/**
		 * @OA\DELETE(
		 * path="/api/roles/{id}",
		 *tags={"Roles"},
		 * summary="Delete specifi role",
		 * description="Delete specifi role",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Role")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the role record",
		 *    in="path",
		 *    name="id",
		 *    required=true,
		 *    example="1",
		 *    @OA\Schema(
		 *       type="integer",
		 *       format="int64"
		 *    )
		 * ),
		 * @OA\Response(
		 *    response=401,
		 *    description="Not authorized",
		 *    @OA\JsonContent(
		 *       @OA\Property(property="message", type="string", example="Not authorized"),
		 *    )
		 * )
		 * )
		 */
		public function destroy(Role $role) {
			$role->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
