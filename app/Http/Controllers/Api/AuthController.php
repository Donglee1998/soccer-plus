<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\JsonResponse;
use App\Repositories\RegistrationRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $_registrationRepo;

    public function __construct(RegistrationRepository $registrationRepository)
    {
        $this->_registrationRepo = $registrationRepository;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $account = $this->_registrationRepo->getAppLogin($request->username);
            if ($account && $account->username == $request->username && Hash::check($request->password, $account->password)) {
                $account->uuid = $request->uuid;
                $token = auth('api')->login($account);

                return $this->response([
                    'access_token' => $token,
                    'token_type'   => 'Bearer',
                ]);
            }else{
                return $this->response([
                    'message' => 'ログインIDもしくはパスワードが間違っています。'
                ], JsonResponse::HTTP_FORBIDDEN);
            }

        } catch (\Exception $e) {
            report($e);
            return $this->responseFailure($e);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
    */
    public function logout() {
        auth('api')->logout();
        return response()->json(['message' => 'ユーザーが正常にサインアウトしました']);
    }

    /**get user info
     *
     * @return \Illuminate\Http\JsonResponse
    */
    public function getUser(Request $request) {
        $user = $request->user();
        $data = [
            'id'       => $user->id,
            'username' => $user->username,
            'type'     => $user->type,
            // 'uuid'  => auth('api')->getPayload()->get('uuid'),
        ];
        return response()->json($data);
    }
}
