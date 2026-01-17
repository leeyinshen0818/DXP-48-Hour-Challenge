<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegistrationController extends Controller
{
    public function complete(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Update user details (using direct assignment to avoid static analysis errors)
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->is_guest = false;
        $user->save();

        return redirect()->route('home')->with('status', 'registration-completed');
    }
}