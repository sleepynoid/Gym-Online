<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MemberController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return Inertia::render('Member/Index', [
            'members' => Member::all(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return Inertia::render('Member/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email', // Valid email, max length, unique in 'users' table
            'phone_number' => 'required|string|max:15|regex:/^[0-9]+$/',  // Ensures only numbers, max 15 digits
            'address' => 'required|string|max:500',  // Max length for the address
            'tier' => 'required|string|in:basic,premium,enterprise', // Restricts values to specific options
        ]);

        // Create a new member with the validated data
        $member = Member::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'tier' => $validatedData['tier'],
        ]);

        // Optional: Return a response, redirect, or perform additional logic
        return redirect()->route('member.create')->with('success', 'Member created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member) {
        try {
            $member->delete();
        } catch (Exception $e) {
            return redirect()->route('member.index')
                ->with('error', 'Failed to delete the member. Please try again.');
        }
    }
}
