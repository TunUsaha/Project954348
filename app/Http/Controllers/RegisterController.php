<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('logins.register');
    }

    public function register(Request $request)
    {
        // Log registration attempt
        Log::info('Registration attempt', $request->all());

        // Validate registration data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user'
            ]);


            // Fire registered event
            event(new Registered($user));

            // Log the user in
            Auth::login($user);

            // Redirect to home page
            return redirect()->route('welcome')
                ->with('success', 'Registration successful! Welcome to our platform.');
        } catch (Exception $e) {
            Log::error('User registration failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Registration failed. Please try again.');
        }
    }

    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            Log::error('Google redirect failed: ' . $e->getMessage());
            return redirect()->route('register')
                ->with('error', 'Unable to connect to Google. Please try again.');
        }
    }

    public function handleGoogleCallback()
{
    try {
        $socialUser = Socialite::driver('google')->user();
        $user = $this->createOrGetSocialUser($socialUser, 'google');

        // Log the user in
        Auth::login($user);

        return redirect()->route('welcome')
            ->with('success', 'Login successful! Welcome back.');
    } catch (Exception $e) {
        Log::error('Google login failed: ' . $e->getMessage());

        // Return user-friendly error message
        return redirect()->route('register')
            ->with('error', 'Unable to login with Google. Please check your internet connection and try again.');
    }
}


    public function redirectToGithub()
    {
        try {
            return Socialite::driver('github')->redirect();
        } catch (Exception $e) {
            Log::error('GitHub redirect failed: ' . $e->getMessage());
            return redirect()->route('register')
                ->with('error', 'Unable to connect to GitHub. Please try again.');
        }
    }

    public function handleGithubCallback()
    {
        try {
            $socialUser = Socialite::driver('github')->user();
            $user = $this->createOrGetSocialUser($socialUser, 'github');

            // Log the user in
            Auth::login($user);

            return redirect()->route('welcome')
                ->with('success', 'Login successful! Welcome back.');
        } catch (Exception $e) {
            Log::error('GitHub login failed: ' . $e->getMessage());
            return redirect()->route('register')
                ->with('error', 'Unable to login with GitHub. Please try again.');
        }
    }

    private function createOrGetSocialUser($socialUser, $provider)
    {
        // Check if user exists with this social id
        $user = User::where($provider . '_id', $socialUser->getId())->first();

        if ($user) {
            return $user;
        }

        // Check if user exists with the same email
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Update user with social id if they exist but haven't used this social login before
            $user->update([
                $provider . '_id' => $socialUser->getId()
            ]);
            return $user;
        }

        // Create new user
        return User::create([
            'name' => $socialUser->getName() ?? $socialUser->getNickname(),
            'email' => $socialUser->getEmail(),
            'password' => Hash::make(Str::random(32)), // Random password for social logins
            'email_verified_at' => now(), // Email is verified by social provider
            $provider . '_id' => $socialUser->getId(),
        ]);
    }
}
