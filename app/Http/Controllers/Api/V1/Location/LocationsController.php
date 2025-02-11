<?php

namespace App\Http\Controllers\Api\V1\Location;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all locations with pagination
        $locations = Location::paginate(10);

        if ($locations->isEmpty()) {
            return response()->json(['message' => 'No locations found'], 404);
        }

        // Return locations as a collection of resources
        return LocationResource::collection($locations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationRequest $request)
    {
        try {
            // Create the location
            $location = Location::create($request->validated());

            // Return the created location as a resource
            return response()->json([
                'message' => 'Location created successfully',
                'location' => new LocationResource($location),
            ], 201);
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
        // If the location does not exist, Laravel's route model binding will handle it (returns 404 automatically).
        return new LocationResource($location);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationRequest $request, Location $location)
    {
        try {
            // Update the location
            $location->update($request->validated());

            // Return the updated location as a resource
            return response()->json([
                'message' => 'Location updated successfully',
                'location' => new LocationResource($location),
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

    public function getUserLocations(Request $request,$userId){

        if($request->user()->id !== (int) $userId){
            return response()->json(['message' => 'You are not authorized to view this location'],
            403);
        }

   // Fetch locations for the specified user
    $locations = Location::where('user_id', $userId)->paginate(10);

    if ($locations->isEmpty()) {
        return response()->json(['message' => 'No locations found for this user'], 404);
    }

    // Return locations as a collection of resources
    return LocationResource::collection($locations);

    }
}