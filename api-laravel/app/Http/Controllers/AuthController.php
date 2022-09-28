<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use \Illuminate\Http\JsonResponse;


use App\User;

class AuthController extends Controller
{
    //
    public function login(Request $request): JsonResponse {

        $userCredentials = $request->only('email', 'password');

        $rules = [
            'email' => ['required'],
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

        $rules = [
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'password' => 'required|min:8'

        ];
        $validate = Validator::make($request->all(), $rules);

        if($validate->fails()){

            return response()->json([
                'error' => true,
                'validates' => $validate->errors(),

            ], Response::HTTP_UNPROCESSABLE_ENTITY);

        }
        User::create(
            $request->except('password') +
            ['password' => Hash::make($request->input('password'))
            ]);

        return response()->json([
            'error' => false,
            'message' => 'User created successfully'
        ]);

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
