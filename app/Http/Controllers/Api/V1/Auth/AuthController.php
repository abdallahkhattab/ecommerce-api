<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Validator;





class AuthController extends Controller
{


     public function register(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email',
             'password' => 'required|min:6|confirmed',
         ]);
     
         if ($validator->fails()) {
             return response()->json([
                 'message' => 'Validation failed.',
                 'errors' => $validator->errors()
             ], 422);
         }
     
         $data = $validator->validated();
         $data['password'] = Hash::make($data['password']);
     
         try {
             $user = User::create($data);
             $token = JWTAuth::fromUser($user);
     
             return response()->json([
                
                 'token' => $token,
                 'data' => new UserResource($user),
             ], 200);
     
         } catch (\Exception $e) {
             return response()->json([
                 'message' => 'Registration failed.',
                 'error' => $e->getMessage()
             ], 500);
         }
     }
     

  
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

   
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials.',
                ], 422);
            }

    $user = JWTAuth::user();
       $user->load('roles'); // Eager-load the roles

        return response()->json([
            'token' => $token,
            'data' => new UserResource($user),
        ]);
    }

  
     public function getAuthenticatedUser(){
      
            $user = JWTAuth::user();
            $user->load('location');

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

       return response()->json(new UserResource($user));
    
    }

    /**
     * Refresh token
     */
    public function refresh()
    {
        try {
            $newToken = JWTAuth::parseToken()->refresh();

            return response()->json([
                'success' => true,
                'token' => $newToken,
            ]);

        } catch (TokenExpiredException $e) {
            return response()->json(['success' => false, 'message' => 'Token expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['success' => false, 'message' => 'Invalid token'], 401);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'message' => 'Token not provided'], 401);
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out',
            ],200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to log out.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
