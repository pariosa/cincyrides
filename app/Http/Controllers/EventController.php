<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use CloudConvert;
use App\event;
use App\User; 
use App\UserEvent;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function single($id) {
        $event = event::find($id);
        return view('event', compact('event'));
    }

    public function editSingle($id) {
        $event = event::find($id);
        return view('edit-event', compact('event'));
    }

    public function create(Request $req) {

     //dd($req);
    $this->validate($req, [
       //'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:4048',
    ]);

    //dd($req,$req->hasFile('image'),$req->input());
     if ($req->hasFile('image')) {
        //dd($req->image->getClientOriginalExtension());
        $imageNamePre = time();
        $imageName = $imageNamePre . '.'.$req->image->getClientOriginalExtension();
        $req->image->move(public_path('upload'), $imageName);
        //dd($req->image); 
        if($req->image->getClientOriginalExtension() == "pdf"){
           //dd(CloudConvert::input('pdf')->conversionTypes());
            CloudConvert::file(public_path('upload').'/'.$imageName)->to('png');
            $imageName = $imageNamePre.'.'.'png';
        }
        $approved = 0;
        $user = auth()->user();
        if($user->admin == 1){
            $approved = 1;
        }



        $event = event::create([
            'event_name' => $req->event_name, 
            'date' => $req->date, 
            'strava_link' => $req->strava_link, 
            'category_id' => $req->category_id, 
            'location' =>   $req->location,
            'description' => $req->description, 
            'image' => $imageName,
            'event_owner_id' => $req->user_id,
            'approved' => $approved,
            ]);
        $event->save();

        return redirect('/event/'.$event->id);
     }

    }

    public function update(Request $req, $id) {
    $user = auth()->user();

    $this->validate($req, [
       'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
    ]);
        $event = event::find($id);

    //dd($req,$req->hasFile('image'),$req->input());
     if ($req->hasFile('image')) {
        $imageName = time().'.'.$req->image->getClientOriginalExtension();
        $req->image->move(public_path('upload'), $imageName);
        //dd($req->image); 

        $event->image = $imageName;
        $event->event_name =    $req->get('event_name');
        $event->date =          $req->get('date');
        $event->strava_link =       $req->get('strava_link');
        $event->category_id =   $req->get('category_id');
        if($user->admin == 1){ $event->approved = 1;}
        $event->description =   $req->get('description'); 
        $event->event_owner_id = $req->get('user_id');
        $event->save();

        return redirect('/event/'.$id);
    }else{

        //dd($event);

        $event->event_name =    $req->get('event_name');
        $event->date =          $req->get('date');
        $event->strava_link =   $req->get('strava_link');
        $event->location  =     $req->get('location');
        $event->category_id =   $req->get('category_id');
        if($user->admin == 1){ $event->approved = 1;}
        $event->description =   $req->get('description');
        $event->image =         $req->get('image');

        $event->event_owner_id = $req->get('user_id');

        $event->save();

        return redirect('/event/'.$id);
    }
    }

    public function filter(Request $req) {
        $events = DB::table('events')->where('approved', 1);

        //$events = event::where('approved', 1)->get();
        
        if($req->get("category")) 
            $events = $events->where("category_id", $req->get("category"))->where('approved', 1);
        if($req->get("location")!= null){
        if($req->get("location")) 
            $events->where("location",'LIKE', $req->get("location"))->where('approved',1);
        }
        if($req->get("date")) 
            $events->whereDate("date", $req->get("date"))->where('approved', 1);

        $events = $events->get();

        if ($events->isEmpty()) {
            $req->session()->flash('alert-danger', 'Nothing was brought back from your search!');
            $events = event::where('approved', 1);
        }

        

        return view('browse', compact('events'));
    }

    public function hosted(Request $req) {
        $user = auth()->user()->id;

        $yourevents = DB::table('events')
                    ->where('events.event_owner_id', '=', $user)
                    ->get();

        if ($yourevents->isEmpty()) {
            $req->session()->flash('alert-empty', 'You haven\'t posted any events yet!');
            return view('hosted-events', compact('yourevents') );
        } else {
            return view('hosted-events', compact('yourevents') );
        }
        
        
    }

    public function add(Request $req, $id) {
        $userevent = UserEvent::where('userID',$req->userID)
                         ->where('eventID', $req->eventID)
                         ->first();

        if (is_null($userevent)) {
            UserEvent::create([
                'userID' => $req->userID, 
                'eventID' => $req->eventID
            ]);
            $req->session()->flash('alert-success', 'You\'ve added that to your calendar!');
        } else {
            $req->session()->flash('alert-danger', 'You already added that to your calendar!');
        }

        return redirect('/event/'.$req->eventID);
    }

    public function remove(Request $req)
    {
        $event = UserEvent::where('userID',$req->userID)
                         ->where('eventID', $req->eventID);
        $event->delete();
        return redirect('/home');
    }

    public function delete(Request $req, $id)
    {
        $others = UserEvent::where('eventID', $req->eventID);
        $others->delete();

        $event = event::where('id', $req->eventID);
        $event->delete();
        return redirect('/hosted-events');
    }
}
