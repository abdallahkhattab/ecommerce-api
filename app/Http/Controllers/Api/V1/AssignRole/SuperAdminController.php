<?php

namespace App\Http\Controllers\Api\V1\AssignRole;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Get authenticated user
            $user = Auth::user();

            // Check if the user has the required role
            if (!$user->hasRole('super-admin')) {
                return response()->json([
                    'message' => 'You are not authorized to access this page',
                ], 403);
            }

            // Fetch all users with their roles, using pagination
            $users = User::with('roles')->paginate(10);

            return response()->json([
                'data' => $users,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|confirmed', // Ensure password confirmation
            ]);

            // Hash the password
            $data['password'] = Hash::make($request->password);

            // Create the user
            $user = User::create($data);

            // Assign the 'admin' role to the user
            $user->roles()->attach($role);

            // Return success response
            return response()->json([
                'message' => 'User created successfully and assigned the admin role',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Get the user by ID
            $user = User::with('roles')->find($id);

            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }

            return response()->json([
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Find the user by ID
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }

            // Update the user
            $user->update($request->only(['name', 'email']));

            return response()->json([
                'message' => 'User updated successfully',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the user by ID
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }

            // Delete the user
            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}