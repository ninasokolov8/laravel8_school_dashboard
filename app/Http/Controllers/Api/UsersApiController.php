<?php
	
	
	namespace App\Http\Controllers\Api;
	
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreUserRequest;
	use App\Http\Requests\UpdateUserRequest;
	use App\Http\Resources\UserResource;
	use App\Models\User;
	use Symfony\Component\HttpFoundation\Response;
	
	class UsersApiController extends Controller {
		/**
		 * @OA\Get(
		 * path="/api/users",
		 * tags={"users"},
		 * summary="Retrieve all users information",
		 * description="Get permissions users with their relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/User")
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
			return new UserResource(User::with(['roles', 'class'])->get());
		}
	
		/**
		 * @OA\Post(
		 * path="/api/users",
		 * tags={"users"},
		 * summary="save new user information",
		 * description="Save user information ",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\RequestBody(
		 *    required=true,
		 *    description="Pass user data",
		 *    @OA\JsonContent(
		 *       required={"name","email","password","roles.*","roles"},
		 *       @OA\Property(property="name", type="string", format="title", example="new user"),
		 *       @OA\Property(property="email", type="email", format="email", example="email@email.com"),
		 *       @OA\Property(property="roles.*", type="int", format="int", example="3"),
		 *       @OA\Property(property="roles", type="array string", format="roles", example="[1,3]")
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/User")
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
		public function store(StoreUserRequest $request) {
			$user = User::create($request->all());
			$user->roles()->sync($request->input('roles', []));
			return (new UserResource($user))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		/**
		 * @OA\Get(
		 * path="/api/users/{id}",
		 *tags={"users"},
		 * summary="Retrieve specific user record information",
		 * description="Get user information with his relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/User")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the user record",
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
		public function show(User $user) {
			return new UserResource($user->load(['roles', 'class']));
		}
		
		/**
		 * @OA\Put(
		 * path="/api/users/{id}",
		 * tags={"users"},
		 * summary="update user information",
		 * description="update user information ",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Parameter(
		 *    description="ID of the user record",
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
		 *    description="Pass user data",
		 *    @OA\JsonContent(
		 *      required={"name","email","password","roles.*","roles"},
		 *       @OA\Property(property="title", type="string", format="title", example="this_is_new_permission"),
		 *       @OA\Property(property="permissions.*", type="int", format="permissions.*", example="1"),
		 *       @OA\Property(property="permissions", type="array string", format="permissions", example="[1,3]")
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/User")
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
		public function update(UpdateUserRequest $request, User $user) {
			$user->update($request->all());
			$user->roles()->sync($request->input('roles', []));
			return (new UserResource($user))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		/**
		 * @OA\DELETE(
		 * path="/api/users/{id}",
		 *tags={"users"},
		 * summary="Delete specifi user",
		 * description="Delete specifi user",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/User")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the user record",
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
		public function destroy(User $user) {
			$user->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
