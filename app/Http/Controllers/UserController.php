<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display user purchase status / dashboard
     */
    public function status()
    {
        // Get current user by session
        $sessionId = session()->getId();
        $user = User::where('session_id', $sessionId)->first();

        // If no user yet (never bought anything)
        if (!$user) {
            return view('users.status', [
                'title' => 'My Purchases',
                'purchases' => [],
            ]);
        }

        // Load purchases with project relationship
        $payments = $user->payments()->with('project')->get();

        return view('users.status', [
            'title' => 'User purchase',
<<<<<<< HEAD
            'payments' => $payments
=======
            'purchases' => $payments
>>>>>>> de2b6997e69300a9248bd708c2caa7fd4e9233fa
        ]);
    }
}
