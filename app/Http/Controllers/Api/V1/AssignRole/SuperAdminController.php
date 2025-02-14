<?php

namespace App\Http\Controllers\Api\V1\AssignRole;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        try {
            // Ensure the authenticated user has the super-admin role
            $user = Auth::user();
            if (!$user || !$user->hasRole('super-admin')) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
    
            // Get search query from request
            $search = $request->query('search');
    
            // Fetch users with optional search functionality
            $users = User::with('roles')
                ->when($search, function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%");
                })
                ->paginate(10);
    
            return response()->json(['data' => UserResource::collection($users)], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
    

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        try {
            // Ensure the authenticated user has the super-admin role
            $authUser = Auth::user();
            if (!$authUser || !$authUser->hasRole('super-admin')) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            // Validate the request data
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed', // Requires password confirmation
                'role' => ['required', Rule::in(['admin', 'editor', 'seller'])], // Restrict allowed roles
            ]);

            // Hash the password
            $data['password'] = Hash::make($request->password);

            // Create the user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            // Assign role
            $role = Role::where('name', $request->role)->first();
            if (!$role) {
                return response()->json(['message' => 'Role not found'], 400);
            }

            $user->roles()->attach($role);

            return response()->json([
                'message' => "User created successfully with the {$request->role} role",
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create user', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        try {
            // Retrieve the user along with roles
            $user = User::with('roles')->find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json(['user' => new UserResource($user)], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        try {
            $authUser = Auth::user();
            if (!$authUser || !$authUser->hasRole('super-admin')) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
    
            // Find the user
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
    
            // Validate input
            $data = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => ['sometimes', 'email', Rule::unique('users')->ignore($user->id)], // Unique except for the same user
                'password' => 'nullable|string|min:6|confirmed', // Optional password update
                'role' => ['sometimes', Rule::in(['admin', 'editor', 'seller'])],
            ]);
    
            // Update user details
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }
    
            $user->update($data);
    
            // Update role if provided
            if ($request->has('role')) {
                $role = Role::where('name', $request->role)->first();
                if (!$role) {
                    return response()->json(['message' => 'Role not found'], 400);
                }
                $user->roles()->sync([$role->id]);
            }
    
            return response()->json([
                "message" => "User updated successfully",
                'user' => new UserResource($user->load('roles'))
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        try {
            $authUser = Auth::user();
            if (!$authUser || !$authUser->hasRole('super-admin')) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            // Find the user
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            // Delete the user
            $user->delete();

            return response()->json(['message' => 'User deleted successfully' , 'user' => new UserResource($user)], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete user', 'error' => $e->getMessage()], 500);
        }
    }
}
