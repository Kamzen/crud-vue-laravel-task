<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use \Illuminate\Http\JsonResponse;


class AuthController extends Controller
{
    //
    public function login(Request $request): JsonResponse {

        $userCredentials = $request->only('email', 'password');

        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];

        $validate = Validator::make($userCredentials, $rules);

        if($validate->fails()){

            return response()->json([
                'error' => true,
                'validates' => $validate->errors(),

            ], Response::HTTP_UNPROCESSABLE_ENTITY);

        }

        if(!auth()->attempt($userCredentials)){
            return response()
                ->json([
                    'error' => false,
                    'invalid' => 'Invalid credentials',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $userToken = auth()->user()->createToken(env('ACCESS_COOKIE_TOKEN', ''))->plainTextToken;

        return response()
            ->json([
                'error' => false,
                'message' => 'User logged in successfully',
                'resp' => auth()->user(),
                'token' => $userToken
            ], Response::HTTP_OK);

    }

    public function register(Request $request){

    }

    public function forgotPassword(Request $request){

    }

    public function resetPassword(Request $request){

    }

    public function refreshToken(Request $request){

    }

    public function getUserInfo(Request $request){

    }

    public function logout(Request $request): JsonResponse
    {

        $request->user()->tokens()->delete();

        return \response()->json([
            'error' => false,
            'message' => 'User logged out successfully'
        ], 200);

    }
}
