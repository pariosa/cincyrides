<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $user = auth()->user()->id;

        $yourevents = DB::table('users')
                    ->join('user_events', 'users.id', '=', 'user_events.userID')
                    ->join('events', 'events.id', '=', 'user_events.eventID')
                    ->select('events.*')
                    ->where('users.id', '=', $user)
                    ->get();

        if ($yourevents->isEmpty()) {
            $req->session()->flash('alert-home-empty', 'You have any events in your calendar yet!');
            return view('home', compact('yourevents') );
        } else {
            return view('home', compact('yourevents') );
        }

    }
}
