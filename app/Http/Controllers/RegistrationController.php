<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RegistrationController extends Controller
{

    public function showSignupForm($token)
    {
        $invitation = DB::table('invitations')->where('token', $token)->first();

        if (!$invitation) {
            return redirect('/')->with('error', 'Invalid or already used invitation token.');
        }

        if (Carbon::now('Asia/Kolkata')->greaterThan($invitation->expires_at)) {
            DB::table('invitations')->where('id', $invitation->id)
            ->update(['signed_up' => 'TimeOut or Expired']);
            return redirect('/')->with('error', 'The invitation link has expired. Please contact the Admin for assistance.');
        }
        

        return view('auth.signup', compact('token', 'invitation'));
    }

    /**
     * Register the invited user with the role specified in the invitation.
     */
    public function register(Request $request, $token)
    {
        // Fetch the invitation
        $invitation = DB::table('invitations')->where('token', $token)->first();

        if (!$invitation) {
            return redirect('/')->with('error', 'Invalid or already used invitation token.');
        }

        // Check expiration time using IST
        if (Carbon::now('Asia/Kolkata')->greaterThan($invitation->expires_at)) {
            return redirect('/')->with('error', 'The invitation link has expired. Please contact the Admin for assistance.');
        }

        // Validate registration data
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user and assign the role from the invitation
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $invitation->email,
            'password' => Hash::make($request->password),
            'role_id' => $invitation->role_id,
            'master_id' => $invitation->master_id,
            'client_id' => auth()->id(), // Assign the Admin as the parent
            'created_at' => Carbon::now('Asia/Kolkata'),
            'updated_at' => Carbon::now('Asia/Kolkata'),
        ]);

        // Mark the invitation as used
        DB::table('invitations')->where('id', $invitation->id)->update(['signed_up' => 'Registered']);

        return redirect('/login')->with('success', 'Account created successfully! Please log in.');
    }
}
