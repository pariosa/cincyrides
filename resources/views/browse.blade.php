@extends('layouts.app')

@section('content')

<div class="jumbotron browse">
    <div class="container">
        <h1>Make some plans!</h1>
        <p>Take a look at what's going on</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class=" panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="text-success">Filters</span></h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('browse') }}" method="post">
                    {{ csrf_field() }}
                    <h5>Category</h5>
                    <select class="form-control" name="category">
                        <option selected disabled>Select</option>
                        <option value="1">Casual Ride</option>
                        <option value="2">Group Event</option>
                        <option value="3">Hiking and Camping</option>
                        <option value="4">Extreme sports </option>
                        <option value="5">Mountain Biking</option>
                        <option value="6">Road Race</option>
                        <option value="7">Time Trial</option>
                        <option value="8">General meetup</option> 
                        <opton value="9">Organizational Meeting</opton>
                    </select>

                    <h5>Location</h5>
                    <input type="text" class="form-control" placeholder="location" name="location" />

                    <h5>Date</h5>
                    <input type="date" class="form-control" name="date" /><br>

                    <button type="submit" class="btn btn-warning center-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))

                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
                @endforeach
              </div> <!-- end .flash-message -->

             <div class="row"> 
            @foreach ( $events as $event )
            <div class="col-md-4 col-sm-6">
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
                    
                    <div class="row text-center">
                            <strong class="text-success">{{ $event->event_name }}</strong><br>
                            <strong>{{ $event->date }}</strong><br>
                            @if($event->location)
                            <strong>{{ $event->locaton}}</strong>
                            @endif


                            @if (!Auth::guest())
                            <a href="/event/{{ $event->id }}" class="btn btn-warning">View event page</a>
                            @endif
                            
                    </div>
                </div>
            </div>
             @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
