@extends('layouts.app')

@section('content')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<div class="jumbotron">
  <div class="container">
    <h1>Did you make a mistake?</h1>
    <p>Update your event below!</p>
  </div>
</div>


<div class="container">
  <div class="row">
    <form action="/edit-event/{{ $event->id }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
      <div class="col-md-6">
        <div class="form-group">
          <label>Name of event:<br></label>
            <input type="text" class="form-control" value="{{ $event->event_name }}" name="event_name" required />
        </div>

        <div class="form-group">
          <label>Date:<br></label>
            <input type="date" class="form-control" name="date" value="{{ $event->date }}" required />
        </div>

        <div class="form-group">
          <label>Where is it? Enter the location:<br></label>
            <input   class="form-control" value="{{ $event->location }}" name="location"   required />
        </div>
                <div class="form-group">

          <label>Is there a Course Map? (strava or google map link, optional):<br></label>
            <input   class="form-control" value="{{ $event->strava_link }}" name="strava_link" />
        </div>
        <div class="form-group">
          <label>Type of event:<br></label>
            <select class="form-control" name="category_id">
              <option>Select</option>
              <option value="1" @if ( $event->category_id == 1 ) selected @endif >Casual Ride</option>
              <option value="2" @if ( $event->category_id == 2 ) selected @endif >Group Event</option>
              <option value="3" @if ( $event->category_id == 3 ) selected @endif >Hiking and Camping</option>
              <option value="4" @if ( $event->category_id == 4 ) selected @endif >Extreme sports</option>
              <option value="5" @if ( $event->category_id == 5 ) selected @endif >Mountain Biking</option>
              <option value="6" @if ( $event->category_id == 6 ) selected @endif >Road Race</option>
              <option value="7" @if ( $event->category_id == 7 ) selected @endif >Time Trial</option>
              <option value="8" @if ( $event->category_id == 8 ) selected @endif >General meetup</option>
              <option value="9" @if ( $event->category_id == 9 ) selected @endif >Organizational Meeting</option>
            </select>
        </div>

        <div class="form-group">
          <label>Tell us all about it:<br>
          <small>Make sure to include the time and location. Tell everyone how awesome it's going to be and what's going on!</small></label>
            <textarea class="form-control" name="description" required>{{ $event->description }}</textarea>
        </div>

      </div>
      <div class="col-md-5 col-md-offset-1">
        <div class="form-group">
          <label>Want to add a photo? Add that URL below:
          </label>
            <input type="file" class="form-control" placeholder="Event" name="image" id="image" value="{{ $event->image }}" />
        </div>
        @if ( $event->image == null )
            <img class="img-responsive" alt="a" src="http://placehold.it/450x450">
        @else
            <img class="img-responsive" alt="a" src="/upload/{{ $event->image }}">
        @endif
      </div>
      <div class="col-md-12">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
        <input type="hidden" name="eventID" value="{{ $event->id }}" />
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>
  </div>
</div>



<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.img-responsive').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#image').change(function(){
        readURL(this);
    });
</script>

@endsection
