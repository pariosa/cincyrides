@extends('layouts.app')

@section('content')

<div class="jumbotron welcome">
    <div class="container">
        <h1>Cinci Bike Rides</h1>
        <p>A website for finding things to do and sharing events you are throwing. It's a space for meeting new friends who share your interests and figuring out what's going on in your city. Sign up or log in to join us.</p>
        <p><a class="btn btn-warning btn-lg" href="/home" role="button">Let's get started &raquo;</a></p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4 text-center">
            <i class="fa fa-users fa-5x text-primary" aria-hidden="true"></i>
            <h2>Find things to do!</h2>
            <p>Cinci Rides helps you find fun cycling related events to do in the Cincinnati area.</p>
        </div>
        <div class="col-md-4 text-center">
            <i class="fa fa-magic fa-5x text-danger" aria-hidden="true"></i>
            <h2>Showcase your event!</h2>
            <p> Post the events you are throwing to let others know the exciting things going on in the city.</p>
        </div>
        <div class="col-md-4 text-center">
            <i class="fa fa-calendar fa-5x text-success" aria-hidden="true"></i>
            <h2>Curate your calendar!</h2>
            <p>You will be able to browse all types of events by type, date or location and add them to your personal calendar. Your dashboard will showcase everything that you've been interested so you don't miss out.</p>
        </div>
    </div>
</div>
@endsection