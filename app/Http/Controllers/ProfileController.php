<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email' .$id,
            'password' => 'nullable|min:6|confirmed',
            'area' => 'nullable|string',
            'street'=>'nullable|string',
            'building'=> 'nullable|string',
            'user_id'=>'nullable',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);

        }

        $data = $validator->validated();

        $user = JWTAuth::user();

        if ($user->id != $id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $user->update([
            'name'=>$data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'password' => isset($data['password']) ? Hash::make($data['password']) : $user->password,
        ]);

        $user->location()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'area' => $data['area'] ?? null,
                'street' => $data['street'] ?? null,
                'building' => $data['building'] ?? null,
            ]
        );
        
        return response()->json(['message' => 'User updated successfully'],200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
