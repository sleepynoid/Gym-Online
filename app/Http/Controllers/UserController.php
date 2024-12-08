<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Redirect;

class UserController extends Controller {
    //
    public function index() {
        return Inertia::render('User/Index', ['users' => User::all()]);
    }

    public function create() {
        return Inertia::render('User/Create');
    }

    public function insert(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // return response()->json([
        //     "message" => "User created successfully.",
        //     'user' => $user, // Optionally include the created user
        // ],200);
        return redirect(route('users.create'));
    }

    public function destroy(Request $request) {
        // Validate the request input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Find the user using the provided name and email
        $user = User::where('name', $request->name)
            ->where('email', $request->email)
            ->first();

        // If the user is not found, return a 404 error
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Delete the user
        $user->delete();

        // Return a success response
        // return response()->json(['message' => 'User deleted successfully.']);
        return Redirect::route('users.index');
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        if (!$user) {
            abort(404);
        }
        return Inertia::render('User/Edit', [
            'user' => $user,
        ]);
    }
}
