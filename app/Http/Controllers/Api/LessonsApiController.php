<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreLessonRequest;
	use App\Http\Requests\UpdateLessonRequest;
	use App\Http\Resources\LessonResource;
	use App\Models\Lesson;
	use Symfony\Component\HttpFoundation\Response;
	
	class LessonsApiController extends Controller {
		/**
		 * @OA\Get(
		 * path="/api/lessons",
		 * tags={"Lessons"},
		 * summary="Retrieve all lessons information",
		 * description="Get lessons information with their relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Lesson")
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
			return new LessonResource(Lesson::with([
				'class', 'teacher', 'class.classUsers', 'grades.students', 'grades'
			])->get());
		}
		
		
		/**
		 * @OA\Post(
		 * path="/api/lessons",
		 * tags={"Lessons"},
		 * summary="save new lesson information",
		 * description="Save lesson information ",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\RequestBody(
		 *    required=true,
		 *    description="Pass grade data",
		 *    @OA\JsonContent(
		 *       required={"class_id","teacher_id","weekday","start_time","end_time"},
		 *       @OA\Property(property="user_id", type="int", format="user_id", example="1"),
		 *       @OA\Property(property="teacher_id", type="int", format="teacher_id", example="1"),
		 *       @OA\Property(property="weekday", type="int", format="weekday", example="2"),
		 *       @OA\Property(property="start_time", type="string", format="date", example="12:00"),
		 *       @OA\Property(property="end_time", type="string", format="date", example="14:00"),
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Lesson")
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
		public function store(StoreLessonRequest $request) {
			$lesson = Lesson::create($request->all());
			return (new LessonResource($lesson))->response()->setStatusCode(Response::HTTP_CREATED);
		}
		
		/**
		 * @OA\Get(
		 * path="/api/lessons/{id}",
		 *tags={"Lessons"},
		 * summary="Retrieve specific lesson record information",
		 * description="Get lesson information with his relationships",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Grade")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the lesson record",
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
		public function show(Lesson $lesson) {
			return new LessonResource($lesson->load([
				'class', 'teacher', 'class.classUsers', 'grades.students', 'grades'
			]));
		}
		
		/**
		 * @OA\Put(
		 * path="/api/lessons/{id}",
		 * tags={"Lessons"},
		 * summary="update lesson information",
		 * description="update lesson information ",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Parameter(
		 *    description="ID of the lesson record",
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
		 *       required={"class_id","teacher_id","weekday","start_time","end_time"},
		 *       @OA\Property(property="user_id", type="int", format="user_id", example="1"),
		 *       @OA\Property(property="teacher_id", type="int", format="teacher_id", example="1"),
		 *       @OA\Property(property="weekday", type="int", format="weekday", example="2"),
		 *       @OA\Property(property="start_time", type="string", format="date", example="12:00"),
		 *       @OA\Property(property="end_time", type="string", format="date", example="14:00"),
		 *    )),
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Lesson")
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
		public function update(UpdateLessonRequest $request, Lesson $lesson) {
			$lesson->update($request->all());
			return (new LessonResource($lesson))->response()->setStatusCode(Response::HTTP_ACCEPTED);
		}
		
		/**
		 * @OA\DELETE(
		 * path="/api/lessons/{id}",
		 *tags={"Lessons"},
		 * summary="Delete specifi lesson",
		 * description="Delete specifi lesson",
		 * security={ {"Authorization" : "Bearer  accessToken"}},
		 * @OA\Response(
		 *    response=200,
		 *    description="Success",
		 *    @OA\JsonContent(
		 *       @OA\Property( type="object", ref="#/components/schemas/Lesson")
		 *        )
		 *     ),
		 * @OA\Parameter(
		 *    description="ID of the lesson record",
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
		public function destroy(Lesson $lesson) {
			$lesson->delete();
			return response(null, Response::HTTP_NO_CONTENT);
		}
	}
