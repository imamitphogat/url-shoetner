<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UrlController extends Controller
{
    
    public function myUrls()
    {
        $urls = DB::table('urls')->where('user_id', auth()->id())->paginate(10);
        return view('urls.index', compact('urls'));
    }

    public function redirect($shortUrl)
    {
        $url = DB::table('urls')->where('short_url', $shortUrl)->first();

        if (!$url) {
            abort(404, 'URL not found');
        }

        DB::table('urls')->where('id', $url->id)->increment('hits');
        return redirect($url->long_url);
    }

    public function stats($shortUrl)
    {
        $url = DB::table('urls')->where('short_url', $shortUrl)->first();

        if (!$url) {
            abort(404, 'URL not found');
        }

        return view('urls.stats', compact('url'));
    }



    public function index()
    {
        $urls = DB::table('urls')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(5); 

        return view('urls.index', compact('urls'));
    }
    public function adminIndexTeam()
    {
        $userDataFromUsers = DB::table('users')
        ->where('id',auth()->id()) 
        ->first();
        $masterUserid = $userDataFromUsers->master_id; 

        $urls = DB::table('urls')
        ->where('master_id', $masterUserid)  
        ->paginate(10);
        return view('admin.team-urls', compact('urls'));
    }
    public function adminIndexSingle()
    {
        $urls = DB::table('urls')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(5); 

        return view('admin.urls', compact('urls'));
    }


    public function memberCreate()
    {   
        return view('urls.createUrl');
    }


    public function adminCreate()
    {
        return view('admin.createUrl');
    }




    public function AdminStore(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url',
        ]);

        $existing = DB::table('urls')
            ->where('long_url', $request->long_url)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            return redirect()->route('admin.dashboard')->with('error', 'This URL is already shortened: ' . url($existing->short_url));
        }

        do {
            $shortUrl = Str::random(6);
        } while (DB::table('urls')->where('short_url', $shortUrl)->exists());

        DB::table('urls')->insert([
            'long_url' => $request->long_url,
            'short_url' => $shortUrl,
            'user_id' => auth()->id(),
            'owner_id' => auth()->id(),
            'master_id' => auth()->user()->master_id,
            'hits' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Short URL created successfully!');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url',
        ]);

        $existing = DB::table('urls')
            ->where('long_url', $request->long_url)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            return redirect()->route('member.urls.index')->with('error', 'This URL is already shortened: ' . url($existing->short_url));
        }

        do {
            $shortUrl = Str::random(6);
        } while (DB::table('urls')->where('short_url', $shortUrl)->exists());

        DB::table('urls')->insert([
            'long_url' => $request->long_url,
            'short_url' => $shortUrl,
            'user_id' => auth()->id(),
            'owner_id' => auth()->id(),
            'master_id' => auth()->user()->master_id,
            'hits' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('member.urls.index')->with('success', 'Short URL created successfully!');
    }



    public function superAdminDestroy($id)
    {
        $url = DB::table('urls')->where('id', $id)->first();

        if (!$url) {
            return redirect()->route('superAdmin.urls.index')->with('error', 'URL not found or unauthorized access.');
        }

        DB::table('urls')->where('id', $id)->delete();

        return redirect()->route('superAdmin.urls.index')->with('success', 'URL deleted successfully!');
    }

    public function adminDestroy($id)
    {
        $url = DB::table('urls')->where('id', $id)->where('user_id', auth()->id())->orwhere('master_id',auth()->user()->master_id)->first();

        if (!$url) {
            return redirect()->route('admin.dashboard')->with('error', 'URL not found or unauthorized access.');
        }

        DB::table('urls')->where('id', $id)->delete();

        return redirect()->route('admin.dashboard')->with('success', 'URL deleted successfully!');
    }








}
