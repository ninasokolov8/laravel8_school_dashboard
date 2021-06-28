<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreSchoolClassRequest;
	use App\Http\Requests\UpdateSchoolClassRequest;
	use App\Http\Resources\SchoolClassResource;
	use App\Models\SchoolClass;
	use Symfony\Component\HttpFoundation\Response;
	
	class SchoolClassesApiController extends Controller {
		/**
		 * @OA\Get(
		 * path="/api/school-classes",
		 * tags={"school-classes"},
		 * summary="Retrieve all chool-classes information",
		 * description="Get permissions chool-classes with their relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/SchoolClass")
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
			return new SchoolClassResource(SchoolClass::all());
		}
		
		/**
		 * @OA\Post(
		 * path="/api/school-classes",
		 * tags={"school-classes"},
		 * summary="save new school-classes information",
		 * description="Save school-classes information ",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\RequestBody(
		 *    required=true,
		 *    description="Pass school-classes data",
		 *    @OA\JsonContent(
		 *       required={"name"},
		 *       @OA\Property(property="name", type="string", format="name", example="this_is_new_class"),
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/SchoolClass")
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
		public function store(StoreSchoolClassRequest $request) {
			$schoolClass = SchoolClass::create($request->all());
			return (new SchoolClassResource($schoolClass))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		
		/**
		 * @OA\Get(
		 * path="/api/school-classes/{id}",
		 *tags={"school-classes"},
		 * summary="Retrieve specific school-classes record information",
		 * description="Get school-classes information with his relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/SchoolClass")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the school-classes record",
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
		public function show(SchoolClass $schoolClass) {
			return new SchoolClassResource($schoolClass);
		}
		
		/**
		 * @OA\Put(
		 * path="/api/school-classes/{id}",
		 * tags={"school-classes"},
		 * summary="update school-classe information",
		 * description="update school-classe information ",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Parameter(
		 *    description="ID of the school-classe record",
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
		 *      required={"name"},
		 *       @OA\Property(property="name", type="string", format="name", example="this_is_new_SchoolClass"),
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/SchoolClass")
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
		public function update(UpdateSchoolClassRequest $request, SchoolClass $schoolClass) {
			$schoolClass->update($request->all());
			return (new SchoolClassResource($schoolClass))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		/**
		 * @OA\DELETE(
		 * path="/api/school-classes/{id}",
		 *tags={"school-classes"},
		 * summary="Delete specifi school-classe",
		 * description="Delete specifi school-classe",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/SchoolClass")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the school-classe record",
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
		public function destroy(SchoolClass $schoolClass) {
			$schoolClass->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
