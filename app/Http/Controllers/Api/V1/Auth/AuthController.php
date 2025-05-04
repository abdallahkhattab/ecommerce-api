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
                 'user' => new UserResource($user),
             ], 201);
     
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
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

    $user = JWTAuth::user();
       $user->load('roles'); // Eager-load the roles

        return response()->json([
            'token' => $token,
            'user' => new UserResource($user),
        ]);
    }

  
    public function getAuthenticatedUser()
    {
        try {
            $user = JWTAuth::user();

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            return response()->json(new UserResource($user));
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token not provided'], 401);
        }
    }

      /**
     * @OA\Post(
     *     path="/auth/refresh",
     *     tags={"Authentication"},
     *     summary="Refresh authentication token",
     *     description="Refreshes the current authentication token",
     *     operationId="refresh",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Token refreshed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized (invalid or expired token)",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function refresh()
    {
        try {
            $newToken = JWTAuth::parseToken()->refresh();

            return response()->json(['token' => $newToken]);
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token not provided'], 401);
        }
    }


    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     tags={"Authentication"},
     *     summary="Logout user",
     *     description="Invalidates the current authentication token",
     *     operationId="logout",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully logged out",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Successfully logged out")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized (invalid or expired token)",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to log out",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Successfully logged out']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to log out'], 500);
        }
    }
}