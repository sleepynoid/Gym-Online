<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Str;

class GoogleController extends Controller {
    /**
     * Redirect to Google.
     */
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google callback.
     */
    public function handleGoogleCallback() {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the user exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create a new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(), // Store Google ID
                    'password' => bcrypt(Str::random(16)), // Optional: Auto-generate password
                ]);
            }

            // Log the user in
            Auth::login($user);

            // Redirect to the dashboard or desired route
            return redirect()->route('dashboard')->with('success', 'Logged in successfully with Google!');

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('Something went wrong with Google login.');
        }
    }
}
