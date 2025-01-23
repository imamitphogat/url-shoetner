<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
  
    public function dashboard()
    {        
        $invitations = DB::table('invitations')->paginate(10);
        $roles = DB::table('roles')->whereIn('id', [2])->get(); 
        return view('superadmin.dashboard', compact('invitations', 'roles'));
    }

  
    public function invite(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:invitations,email',  
            'master_id' => 'required|unique:users,master_id',          
            'role_id' => 'required|exists:roles,id', 
        ]);

        $token = \Str::random(40);

        $expiresAt = Carbon::now('Asia/Kolkata')->addMinutes(30);

        DB::table('invitations')->insert([
            'email' => $request->email,            
            'role_id' => $request->role_id,
            'invited_by' => auth()->id(),
            'master_id' => $request->master_id,
            'token' => $token,
            'expires_at' => $expiresAt,
            'created_at' => Carbon::now('Asia/Kolkata'),
            'updated_at' => Carbon::now('Asia/Kolkata'),
        ]);

        $link = route('signup', ['token' => $token]);
        Mail::to($request->email)->send(new InvitationMail($link));

        return back()->with('success', "Invitation sent successfully!  $link");
    }


    public function viewUrls()
    {
        $urls = DB::table('urls')->paginate(10);
        return view('superadmin.urls', compact('urls'));
    }


    public function downloadUrls()
    {
        $urls = DB::table('urls')->get();
        $filename = "short_urls.csv";
        $handle = fopen($filename, 'w');
        fputcsv($handle, ['ID', 'Long URL', 'Short URL', 'Hits']);

        foreach ($urls as $url) {
            fputcsv($handle, [$url->id, $url->long_url, url($url->short_url), $url->hits]);
        }

        fclose($handle);
        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function inviteDelete($id)
    {       

        $invitation = DB::table('invitations')->where('id', $id)->first();

        if (!$invitation) {
            return redirect()->route('superadmin.dashboard')->with('error', 'Invitation Not Found.');
        }
        
        DB::table('invitations')->where('id', $id)->delete();


        // Redirect back with a success message
        return redirect()->route('superadmin.dashboard')->with('success', 'Invitation deleted successfully!');

    }
}
