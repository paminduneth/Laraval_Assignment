<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CalendarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user || !$user->google_token) {
            return redirect('/login')->with('error', 'Google authentication required.');
        }

        $client = new Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        // Prepare token
        $accessToken = json_decode($user->google_token, true) ?? ['access_token' => $user->google_token];
        $client->setAccessToken($accessToken);

        // Refresh if expired
        if ($client->isAccessTokenExpired() && $user->google_refresh_token) {
            try {
                $client->fetchAccessTokenWithRefreshToken($user->google_refresh_token);
                $newToken = $client->getAccessToken();
                $user->update(['google_token' => json_encode($newToken)]);
                Log::info('Refreshed Google token for user: ' . $user->id);
            } catch (\Exception $e) {
                Log::error('Token refresh failed: ' . $e->getMessage());
                return redirect('/login')->with('error', 'Google session expired. Please log in again.');
            }
        }

        try {
            $service = new Calendar($client);
            $events = $service->events->listEvents('primary', ['maxResults' => 10]);
            return view('calendar', ['events' => $events->getItems()]);
        } catch (\Exception $e) {
            Log::error('Calendar API error: ' . $e->getMessage());
            return redirect('/dashboard')->with('error', 'Failed to load calendar: ' . $e->getMessage());
        }
    }
}