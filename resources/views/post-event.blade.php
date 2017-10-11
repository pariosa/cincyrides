@extends('layouts.app')

@section('content')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<div class="jumbotron post">
  <div class="container">
    <h1>Awesome!</h1>
    <p>Let us know all about the event you want to share by filling out the form below</p>
  </div>
</div>

<div class="container">
  <div class="row">
    <form action="{{ url('create-event') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
      <div class="col-md-6">
        <div class="form-group">
          <label>Name of event:<br></label>
            <input type="text" class="form-control" placeholder="Event" name="event_name" required />
        </div>

        <div class="form-group">
          <label>Date:<br></label>
            <input type="date" class="form-control" name="date" required />
        </div>

        <div class="form-group">
          <label>Where is it? Enter the location:<br></label>
            <input type="text" class="form-control" placeholder="location" name="location"   required />
        </div>
        <div class="form-group">
          <label>Link to Strava or Google map:<br></label>
            <input type="text" class="form-control" placeholder="url Eg. Https://.." name="strava_link"   required />
        </div>
        <div class="form-group">
          <label>Type of event:<br></label>
            <select class="form-control" name="category_id">
              <option value="1">Casual Ride</option>
              <option value="2">Group Event</option>
              <option value="3">Hiking and Camping</option>
              <option value="4">Extreme sports </option>
              <option value="5">Mountain Biking</option>
              <option value="6">Road Race</option>
              <option value="7">Time Trial</option>
              <option value="8" selected>General meetup</option> 
              <opton value="9">Organizational Meeting</opton>
            </select>
        </div>

        <div class="form-group">
          <label>Tell us all about it:<br>
          <small>Make sure to include the time and location. Tell everyone how awesome it's going to be and what's going on!</small></label>
            <textarea class="form-control" name="description" required></textarea>
        </div>

      </div>
      <div class="col-md-5 col-md-offset-1">
        <div class="form-group">
          <label>Want to add a photo? Add that URL below:
          </label>
            <input type="file" class="form-control" placeholder="Event" name="image" id="image" />
        </div>
        <img class="img-responsive" src="http://placehold.it/450" />
      </div>
      <div class="col-md-12">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
        <button type="submit" class="btn btn-lg btn-warning center-block">Submit</button>
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
    $("#image").change(function(){
        readURL(this);
    });
</script>

@endsection
