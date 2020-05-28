<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class ForgotPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            if ($result = $this->_userRepository->checkPassword($request)) {
                $token = $this->_userRepository->updateToken($result->email);
                return redirect('password/reset/' . $token);
                $success['name'] =  $result->name;
                return response()->json(['meta' => ['code' => Response::HTTP_OK, 'message' => 'OK'], 'result' => $success], Response::HTTP_OK);
            } else {
                return response()->json(['meta' => ['code' => 401, 'message' => ['error' => 'Unauthorised']]], 401);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        try {
            dd($this->_userRepository->confirmPassword($request));
            if ($result = $this->_userRepository->confirmPassword($request)) {
                return response()->json(['meta' => ['code' => Response::HTTP_OK, 'message' => 'OK'], 'result' => 'OK'], Response::HTTP_OK);
            } else {
                return response()->json(['meta' => ['code' => 401, 'message' => ['error' => 'Unauthorised']]], 401);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
