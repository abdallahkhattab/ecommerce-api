<?php

namespace App\Http\Controllers\Api\V1\Complaint;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class ComplaintController extends Controller
{
    public function store(Request $request)
    {
        $user = JWTAuth::user();

        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $complaint = Complaint::create([
            'user_id' => $user->id,
            'description' => $request->description,
        ]);

        return response()->json([
            'code'=>200,
            'data' => [
            'message' => 'Complaint submitted successfully.',
            'complaint' => $complaint
            ]
         
        ], 200);
    }
}
