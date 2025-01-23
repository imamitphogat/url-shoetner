<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function dashboard()
    {
        $roles = DB::table('roles')->whereIn('id', [2, 3])->get(); 


        $invitations = DB::table('invitations')
            ->where('invited_by',auth()->id()) 
            ->paginate(10);

        return view('admin.dashboard', compact( 'invitations' , 'roles'));
    }

    public function teamDashboard()
    {
        
        $userDataFromUsers = DB::table('users')
        ->where('id',auth()->id()) 
        ->first();
        $masterUserid = $userDataFromUsers->master_id; 

        $teamMembers = DB::table('users')
        ->where('master_id', $masterUserid)  
        ->paginate(10);

        $roles = DB::table('roles')->whereIn('id', [2, 3])->get(); 

        return view('admin.team', compact('teamMembers', 'roles'));
    }

    public function inviteMember(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:invitations,email',
            'role_id' => 'required|exists:roles,id', 
        ]);

        $token = \Str::random(40);

        $expiresAt = Carbon::now('Asia/Kolkata')->addMinutes(30);

        $iivt_id = DB::table('users')->where('id', auth()->id())->first();
        
        if(empty($iivt_id->client_id)){
            $invited_for = auth()->id();
        }else{
            $invited_for = $iivt_id->client_id;
        }


        DB::table('invitations')->insert([
            'email' => $request->email,
            'role_id' => $request->role_id,            
            'invited_by' => auth()->id(),
            'master_id' => auth()->user()->master_id,
            'invited_for' => $invited_for,            
            'token' => $token,
            'expires_at' => $expiresAt,
            'created_at' => Carbon::now('Asia/Kolkata'),
            'updated_at' => Carbon::now('Asia/Kolkata'),
        ]);

        $link = route('signup', ['token' => $token]);
        Mail::to($request->email)->send(new InvitationMail($link));

        return back()->with('success', "Invitation sent successfully!");
    }


    public function viewTeamUrls()
    {
        $userDataFromUsers = DB::table('users')
        ->where('id',auth()->id()) 
        ->first();
        $masterUserid = $userDataFromUsers->master_id; 

        $urls = DB::table('urls')
        ->where('master_id', $masterUserid)  
        ->paginate(10);


        /* $urls = DB::table('urls')
            ->join('users', 'urls.user_id', '=', 'users.id')
            ->where('users.client_id', auth()->id())
            ->select('urls.*')
            ->paginate(10); */

        return view('admin.team-urls', compact('urls'));
    }

    
    public function downloadUrls()
    {
        $userDataFromUsers = DB::table('users')
        ->where('id',auth()->id()) 
        ->first();
        $masterUserid = $userDataFromUsers->master_id; 

   

        $urls = DB::table('urls')->where('master_id', $masterUserid)->get();
        $filename = "short_urls.csv";
        $handle = fopen($filename, 'w');
        fputcsv($handle, ['ID', 'Long URL', 'Short URL', 'Hits']);

        foreach ($urls as $url) {
            fputcsv($handle, [$url->id, $url->long_url, url($url->short_url), $url->hits]);
        }

        fclose($handle);
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
