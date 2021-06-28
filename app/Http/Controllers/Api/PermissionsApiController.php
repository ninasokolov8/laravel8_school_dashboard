<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StorePermissionRequest;
	use App\Http\Requests\UpdatePermissionRequest;
	use App\Http\Resources\PermissionResource;
	use App\Models\Permission;
	use Symfony\Component\HttpFoundation\Response;
	
	class PermissionsApiController extends Controller {
		/**
		 * @OA\Get(
		 * path="/api/permissions",
		 * tags={"Permissions"},
		 * summary="Retrieve all permissions information",
		 * description="Get permissions information with their relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Permission")
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
			return new PermissionResource(Permission::all());
		}
		
		/**
		 * @OA\Post(
		 * path="/api/permissions",
		 * tags={"Permissions"},
		 * summary="save new permission information",
		 * description="Save permission information ",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\RequestBody(
		 *    required=true,
		 *    description="Pass grade data",
		 *    @OA\JsonContent(
		 *       required={"title"},
		 *       @OA\Property(property="title", type="string", format="title", example="this_is_new_permission")
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Permission")
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
		public function store(StorePermissionRequest $request) {
			$permission = Permission::create($request->all());
			return (new PermissionResource($permission))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		/**
		 * @OA\Get(
		 * path="/api/permissions/{id}",
		 *tags={"Permissions"},
		 * summary="Retrieve specific permission record information",
		 * description="Get permission information with his relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Permission")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the permission record",
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
		public function show(Permission $permission) {
			return new PermissionResource($permission);
		}
		/**
		 * @OA\Put(
		 * path="/api/permissions/{id}",
		 * tags={"Permissions"},
		 * summary="update permission information",
		 * description="update permission information ",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Parameter(
		 *    description="ID of the permission record",
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
		 *    description="Pass permissions data",
		 *    @OA\JsonContent(
		 *        required={"title"},
		 *       @OA\Property(property="title", type="string", format="title", example="this_is_new_permission")
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Permission")
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
		public function update(UpdatePermissionRequest $request, Permission $permission) {
			$permission->update($request->all());
			return (new PermissionResource($permission))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		
		/**
		 * @OA\DELETE(
		 * path="/api/permissions/{id}",
		 *tags={"Permissions"},
		 * summary="Delete specifi permission",
		 * description="Delete specifi permission",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Permission")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the permission record",
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
		public function destroy(Permission $permission) {
			$permission->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
