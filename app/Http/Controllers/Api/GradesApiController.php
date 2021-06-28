<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Http\Resources\GradesResource;
	use App\Models\Grade;
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreGradeRequest;
	use App\Http\Requests\UpdateGradeRequest;
	use Illuminate\Http\Resources\Json\JsonResource;
	use Symfony\Component\HttpFoundation\Response;
	
	class GradesApiController extends Controller {
		/**
		 * @OA\Get(
		 * path="/api/grades",
		 * tags={"Grades"},
		 * summary="Retrieve all grades information",
		 * description="Get grades information with their relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Grade")
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
			return new GradesResource(Grade::with(['teachers', 'students', 'lessons'])->get());
		}
		
		
		/**
		 * @OA\Post(
		 * path="/api/grades",
		 * tags={"Grades"},
		 * summary="save new grade information",
		 * description="Save grade information for user",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\RequestBody(
		 *    required=true,
		 *    description="Pass grade data",
		 *    @OA\JsonContent(
		 *       required={"user_id","lesson_id","teacher_id","grade"},
		 *       @OA\Property(property="user_id", type="int", format="user_id", example="1"),
		 *       @OA\Property(property="lesson_id", type="int", format="lesson_id", example="2"),
		 *       @OA\Property(property="teacher_id", type="int", format="teacher_id", example="3"),
		 *       @OA\Property(property="grade", type="int", format="grade", example="99"),
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Grade")
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
		public function store(StoreGradeRequest $request) {
			$grade = Grade::create($request->all());
			return (new GradesResource($grade))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		
		/**
		 * @OA\Put(
		 * path="/api/grades/{id}",
		 * tags={"Grades"},
		 * summary="update grade information",
		 * description="update grade information for user",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Parameter(
		 *    description="ID of the graade record",
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
		 *    description="Pass grade data",
		 *    @OA\JsonContent(
		 *       required={"user_id","lesson_id","teacher_id","grade"},
		 *       @OA\Property(property="user_id", type="int", format="user_id", example="1"),
		 *       @OA\Property(property="lesson_id", type="int", format="lesson_id", example="2"),
		 *       @OA\Property(property="teacher_id", type="int", format="teacher_id", example="3"),
		 *       @OA\Property(property="grade", type="int", format="grade", example="99"),
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Grade")
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
		public function update(UpdateGradeRequest $request, Grade $grade) {
			$grade->update($request->all());
			return (new GradesResource($grade))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		
		/**
		 * @OA\Get(
		 * path="/api/grades/{id}",
		 *tags={"Grades"},
		 * summary="Retrieve specific grade record information",
		 * description="Get grade information with his relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Grade")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the graade record",
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
		public function show(Grade $grade):GradesResource {
			return new GradesResource($grade->load('teachers', 'students', 'lessons'));
		}
		
		/**
		 * @OA\DELETE(
		 * path="/api/grades/{id}",
		 *tags={"Grades"},
		 * summary="Delete specifi grade",
		 * description="Delete specifi grade",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Grade")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the graade record",
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
		public function destroy(Grade $grade) {
			$grade->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
		
	}
