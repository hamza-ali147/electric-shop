<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth; // <-- Added missing semicolon
use Illuminate\Support\Facades\Hash; // <-- Corrected Hash import

class SocialiteController extends Controller
{
    /**
     * Function: googleLogin
     * Description: This function will redirect to Google for authentication
     * @param NA
     * @return void
     */
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Function: googleAuthentication
     * Description: This function will authenticate the user through the Google account
     * @param NA
     * @return void
     */
    public function googleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $googleUser->id)->first();
            
            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('password@1234'), // Default password for new users
                    'google_id' => $googleUser->id,
                ]);
                
                if ($userData) {
                    Auth::login($userData);
                    return redirect()->route('dashboard');
                }
            }
        } catch (Exception $e) {
            dd($e); // Display the error message for debugging
        }
    
    }
}
