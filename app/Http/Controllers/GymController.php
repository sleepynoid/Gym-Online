<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GymController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return Inertia::render('Gym/Index', ['gyms' => Gym::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return Inertia::render('Gym/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        // Parse location data (e.g., longitude and latitude)
        $locationData = explode(',', $request->location);
        if (count($locationData) !== 2) {
            return back()->withErrors(['location' => 'Invalid location format. Expected format: Longitude, Latitude.']);
        }

        [$longitude, $latitude] = $locationData;

        $gym = Gym::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        // Optionally save longitude and latitude in separate columns if your database supports it
        // $gym->longitude = $longitude;
        // $gym->latitude = $latitude;
        // $gym->save();

        return redirect(route('gym.create'))->with('success', 'Gym created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gym $gym) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gym $gym) {
        $gym = Gym::findOrFail($gym->id);
        return Inertia::render('Gym/Edit', [
            'gym' => $gym,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gym $gym) {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
        ]);

        $gym->update($request->only(['name', 'location']));

        return redirect()->route('gym.edit', $gym->id)->with('success', 'Gym information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gym $gym) {
        try {
            $gym->delete(); // Deletes the gym instance

            // return response()->json([
            //     'message' => 'Gym deleted successfully.',
            //     'success' => true,
            // ], 200);
            return redirect(route('gym.index'));
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete the gym. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
