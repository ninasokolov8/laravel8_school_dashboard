<?php
	
	namespace App\Http\Controllers\Api;
	
	use Illuminate\Http\Request;
	use App\Http\Controllers\API\BaseController as BaseController;
	use Illuminate\Support\Facades\Auth;
	
	class RegisterController extends BaseController {
		
		/**
		 * Login api
		 *
		 * @return \Illuminate\Http\JsonResponse
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
