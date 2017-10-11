@extends('layouts.app')

@section('content')


<div class="jumbotron">
  <div class="container">
    <h1>{{ $event->event_name }}</h1>
    <p></p>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-6 col-md-3">
      @if ( $event->image == null ) 
                        @php
                        switch ($event->category_id) {
                            case 1:
                                echo'<img class="img-responsive" alt="a" src="http://www.junodownload.com/plus/wp-content/uploads/2012/10/jabu-jabu-300x300.jpg">';
                                break;
                            case 2:
                                echo'<img class="img-responsive" src="/images/purple.jpg"/>';
                                break;
                            case 3:
                                echo'<img class="img-responsive" src="https://www.themebeta.com/files/windows/images/201701/03/b54a644f8db05ce260d57c07f6a68509.jpeg">';
                                break;
                            case 4:
                                echo'<img class="img-responsive" src="http://img.freepik.com/free-vector/geometric-pattern-with-lines-and-dots_1319-88.jpg?size=338&ext=jpg">';
                                break;
                            case 5:
                                echo'<img class="img-responsive" src="/images/boxes.jpg">';
                                break;
                            case 6:
                                echo'<img class="img-responsive" src="/images/boxes.jpg">';
                                break;
                            case 7:
                                echo'<img class="img-responsive" src="/images/purple.jpg"/>';
                                break;
                            case 8:
                                echo'<img class="img-responsive" src="https://www.themebeta.com/files/windows/images/201701/03/b54a644f8db05ce260d57c07f6a68509.jpeg">';
                                break;
                            default:
                                echo'<img class="img-responsive" alt="a" src="http://img.freepik.com/free-vector/geometric-pattern-with-lines-and-dots_1319-88.jpg?size=338&ext=jpg">';
                        }
                        @endphp
        @else
            <img class="img-responsive" alt="a" src="/upload/{{ $event->image }}" onerror="this.src = 'http://www.junodownload.com/plus/wp-content/uploads/2012/10/jabu-jabu-300x300.jpg'">
        @endif
      @if (auth()->user())
      <form action="{{ url('event/{id}') }}" method="post">
      {{ csrf_field() }}
        <input type="hidden" name="userID" value="{{ Auth::user()->id }}" />
        <input type="hidden" name="eventID" value="{{ $event->id }}"/>

        <button type="submit" class="btn btn-warning center-block">Add to my events</button>

      </form>
        @if(auth()->user()->admin == 1 || auth()->user()->id == $event->event_owner_id)
        <form action="/edit-event/{{ $event->id }}">
        <button  href="/edit-event/{{ $event->id }}" type="submit" class="btn btn-success center-block">Edit your event</button>
      </form>
        @endif
      @endif 
      <div class="flash-message" style="margin-top: 10px;">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> <!-- end .flash-message -->
    </div>

    <div class="col-sm-6 col-md-9">
      <h2><span class="text-success">{{ $event->event_name }}</span></h2>
      <p>{{ $event->date }}</p>
      <p>{{ $event->location }}</p>
      <p style="white-space: pre-line;">{{ $event->description }}</p>
          @if($event->strava_link ) 
    <strong><a href="{{$event->strava_link}}" target="_blank">{{$event->strava_link}}</a></strong>
    @endif
    </div>

  </div>
</div>
        
@endsection