<?php
	
	namespace App\Http\Controllers\Api;
	
	use Illuminate\Http\Request;
	use App\Http\Controllers\API\BaseController as BaseController;
	use Illuminate\Support\Facades\Auth;
	
	class RegisterController extends BaseController {
		
		/**
		 * @OA\Post(
		 * path="api/api-login",
		 * summary="Sign in",
		 * description="Login by email, password",
		 * operationId="authLogin",
		 * tags={"auth"},
		 * @OA\RequestBody(
		 *    required=true,
		 *    description="Pass user credentials",
		 *    @OA\JsonContent(
		 *       required={"email","password"},
		 *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
		 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
		 *    ),
		 * ),
		 * @OA\Response(
		 *    response=422,
		 *    description="Wrong credentials response",
		 *    @OA\JsonContent(
		 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
		 *        )
		 *     )
		 * )
		 */
		public function login(Request $request):\Illuminate\Http\JsonResponse {
			
			if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
				$user = Auth::user();
				$success['token'] = $user->createToken('MyApp')->accessToken;
				$success['name'] = $user->name;
				
				return $this->sendResponse($success, 'User login successfully.');
			} else {
				return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
			}
		}
	}
