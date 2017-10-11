@extends('layouts.app')

@section('content')
<div class="jumbotron host">
    <div class="container">
        <h1>Here are the events  you are hosting!</h1>
        <p>Below you can see your events--you can also update them or remove them all together</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Your Upcoming Events</h2>
            <div class="flash-message">
        @foreach (['empty'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }} alert-danger">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          <div class="empty-message">
              <p>If you'd like to host an event, click <a href="/post-event">Post Event</a> in the navigation and it will be added here</p>
          </div>
          @endif

        @endforeach
      </div> <!-- end .flash-message -->
        </div>

        @foreach ( $yourevents as $event )
            <div class="col-md-3 col-sm-6">
                <div class="well">
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
                    <div class="text-center">
                        <strong class="text-primary">{{ $event->event_name }}</strong><br>
                        <strong>{{ $event->date }}</strong><br>
                        <a href="/event/{{ $event->id }}" class="btn btn-warning">View event page</a>
                        <a href="/edit-event/{{ $event->id }}" class="btn btn-success">Edit your event</a>
                        <form action="{{ url('hosted-events/{id}') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="eventID" value="{{ $event->id }}"/>
                            <button type="submit" class="btn btn-info">Delete event</button>
  
                          </form>
                            
                    </div>
                </div>
            </div>
        @endforeach


    </div>
</div> 

@endsection
