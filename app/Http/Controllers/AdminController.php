<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\event;

class AdminController extends Controller
{
  

    public function makeAdmin(){
        //dd(auth()->user()->id);
        $id = auth()->user();
        $user = User::where('id',$id->id)->first();
        if($user->email == 'ariosa@gmail.com'){
            $user->admin = 1;
            $user->save();
        }
        return redirect('home');
    }

    public function users(){

    	$users = User::paginate(20);
    	$with = ['users' => $users
    	];

    	return view('admin/users')->with($with);
    }

    public function events(){
    	$events = event::paginate(20);
    	$with = ['events' => $events];
    	return view('admin/events')->with($with);

    }

    public function promote($id){
    $user  = auth()->user();

	    if($user->admin == 1){
	    	$admin = user::where('id', '=', $id)->first();
	    	$admin->admin = 1; 
	    	$admin->save();
	    	return redirect('admin');
	    }
	    else{
	    	return back();
	    }
    }

    public function demote($id){

    	$user  = auth()->user();

	    if($user->admin == 1){
	    	$admin = user::where('id', '=', $id)->first();
	    	if($admin->email != 'ariosa@gmail.com'){
	    	$admin->admin = 0; 
	    	$admin->save();
	    	return redirect('admin');
	    	}
	    	else{return back(); }
	    }
	    else{
	    	return back();
	    }
    }
    public function approve($id){
    $user  = auth()->user();

    $event = event::where('id', $id)->first();
    if($user->admin == 1){
    	$event->approved = 1;
    	$event->save();
    }
    return back();
    }
    public function suspend($id){
    $user  = auth()->user();

    $event = event::where('id', $id)->first();
    if($user->admin == 1){
        $event->approved = 0;
        $event->save();
    }
    return back();
    }
}

