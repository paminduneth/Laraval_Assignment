<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        if (env('APP_ENV') === 'local') {
            Config::set('socialite.services.google.guzzle', [
                'verify' => false,
                'curl' => [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false],
            ]);
        }
        
        return Socialite::driver('google')
            ->scopes([
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/userinfo.profile',
                'https://www.googleapis.com/auth/calendar.readonly',
                'https://www.googleapis.com/auth/gmail.readonly',
                'https://www.googleapis.com/auth/tasks.readonly',
            ])
            ->redirect();
    }

    public function callback()
    {
        try {
            if (env('APP_ENV') === 'local') {
                Config::set('socialite.services.google.guzzle', [
                    'verify' => false,
                    'curl' => [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false],
                ]);
            }
            
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();
            
            $tokenData = [
                'access_token' => $googleUser->token,
                'refresh_token' => $googleUser->refreshToken,
                'expires_in' => $googleUser->expiresIn,
            ];
            $updates = [
                'google_id' => $googleUser->getId(),
                'google_token' => json_encode($tokenData),
                'google_refresh_token' => $googleUser->refreshToken,
                'google_token_expires_at' => now()->addSeconds($googleUser->expiresIn),
            ];

            if (!$user) {
                $user = User::create(array_merge([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()),
                ], $updates));
            } else {
                $user->update($updates);
            }

            session()->regenerate();
            Auth::login($user, true);
            Log::info('User logged in successfully: ' . $user->email . ', Session: ' . session()->getId());

            return redirect()->intended('/dashboard');
        } catch (Exception $e) {
            Log::error('Google Auth Error: ' . $e->getMessage());
            Log::error('Google Auth Trace: ' . $e->getTraceAsString());
            return redirect('/login')->with('error', 'Google authentication failed: ' . $e->getMessage());
        }
    }
}