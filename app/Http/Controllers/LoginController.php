<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('logins.form');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors([
            'credentials' => 'The provided credentials do not match our records.',
        ]);
    }

    public function redirectToGoogle(): RedirectResponse
{
    Log::info('Redirecting to Google for authentication');
    try {
        // Redirect to Google with the option to select account
        return Socialite::driver('google')->redirect(['prompt' => 'select_account']);
    } catch (Exception $e) {
        // Log the error if the redirect fails
        Log::error('Google redirect failed: ' . $e->getMessage());
        return redirect()->route('login')->with('error', 'Unable to connect to Google. Please try again.');
    }
}



public function handleGoogleCallback(): RedirectResponse
{
    try {
        $socialUser = Socialite::driver('google')->user();
        $user = $this->handleSocialLogin($socialUser, 'google');

        return redirect()->intended('/')->with('success', 'Successfully logged in with Google!');
    } catch (Exception $e) {
        Log::error('Google callback failed: ' . $e->getMessage());
        return redirect()->route('login')->with('error', 'Google authentication failed. Please try again.');
    }
}

    public function redirectToGithub(): RedirectResponse
    {
        try {
            return Socialite::driver('github')->redirect(['prompt' => 'select_account']);
        } catch (Exception $e) {
            Log::error('GitHub redirect failed: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Unable to connect to GitHub. Please try again.');
        }
    }

    public function handleGithubCallback(): RedirectResponse
    {
        try {
            $socialUser = Socialite::driver('github')->user();
            $user = $this->handleSocialLogin($socialUser, 'github');

            return redirect()->intended('/')->with('success', 'Successfully logged in with GitHub!');
        } catch (Exception $e) {
            Log::error('GitHub callback failed: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'GitHub authentication failed. Please try again.');
        }
    }

    private function handleSocialLogin($socialUser, $provider): User
    {
        Log::info($provider . ' user data received', [
            'email' => $socialUser->getEmail(),
            'name' => $socialUser->getName(),
            'id' => $socialUser->getId()
        ]);

        $user = User::where($provider . '_id', $socialUser->getId())
            ->orWhere('email', $socialUser->getEmail())
            ->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                $provider . '_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'password' => Hash::make(Str::random(24)),
                'email_verified_at' => now(),
            ]);
        } else {
            $user->update([
                $provider . '_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ]);
        }

        Auth::login($user, true);
        Log::info($provider . ' login successful', ['user_id' => $user->id]);

        return $user;
    }
}
