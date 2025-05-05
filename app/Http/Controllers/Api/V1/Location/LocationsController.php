<?php

namespace App\Http\Controllers\Api\V1\Location;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $locations = Location::paginate(10);

        if ($locations->isEmpty()) {
            return response()->json(['message' => 'No locations found'], 404);
        }

        return
            [
                'locations' => LocationResource::collection($locations),
            ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationRequest $request)
    {
        try {
            $user = Auth::user();
            $data = $request->validated();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            // Create the location

            $data['user_id'] = $user->id;
            $location = Location::create($data);

            // Return the created location as a resource
            return response()->json([
                'code' => 200,
                'message' => 'Location created successfully',
                'location' => new LocationResource($location),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating location',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return [
            'code' => 200,
            'data' => [

                'location' => new LocationResource($location),

            ]
        ];
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(LocationRequest $request, Location $location)
    {
        try {

            $user = Auth::user();

            if (!$user || ($user->id !== $location->user_id && !$user->hasRole('admin'))) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            // Update the location
            $location->update($request->validated());

            // Return the updated location as a resource
            return response()->json([ 'code'=>200,
                'data'=>[
                    'message' => 'Location updated successfully',
                    'location' => new LocationResource($location),
    
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating location',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        try {
            $user = Auth::user();
            if (!$user || ($user->id !== $location->user_id && !$user->hasRole('admin'))) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Delete the location
            $location->delete();

            // Return success message
            return response()->json(['message' => 'Location deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting location',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getUserLocations(Request $request, $userId)
    {
        $user = $request->user();

        if ($user->id !== (int) $userId && !$user->hasRole('admin')) {
            return response()->json(['message' => 'You are not authorized to view these locations'], 403);
        }

        $locations = Location::where('user_id', $userId)->paginate(10);

        return response()->json([
            'message' => $locations->isEmpty() ? 'No locations found' : 'User locations retrieved successfully',
            'locations' => LocationResource::collection($locations),
        ]);
    }
}
