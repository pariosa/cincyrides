@extends('layouts.app')
@section('content')
@if(auth()->user()->admin == 1)

<div class="col-md-6 col-md-offset-3">
<div class="col-md-10 col-md-offset-1">
	<div class="col-md-2">
	Username 
	</div>
	<div class="col-md-4">
	email
	</div> 
	<div class="col-md-2">
	user ID
	</div>
	<div class="col-md-2">
	User Level
	</div>
	<div class="col-md-2">
	Action
	</div>
</div>
@foreach($users as $user)
<div class="col-md-10 col-md-offset-1">
	<div class="col-md-2">
	{{$user->name}} 
	</div>
	<div class="col-md-4">
	{{$user->email}}
	</div>
	<div class="col-md-2">
	{{$user->id}}
	</div>
	<div class="col-md-2">
	@if($user->admin == 0)
	User
	@elseif($user->admin == 1)
	Administrator
	@endif
	</div>
	<div class="col-md-2">
	@if($user->admin == 0)
	<a href="/promote/{{$user->id}}""><buton class="btn btn-warning btn-sm">Make Administrator</buton></a>
	@elseif($user->admin == 1)
	@if ($user->email == 'ariosa@gmail.com')
	<a href="/demote/{{$user->id}}"><buton class="btn btn-default btn-default btn-sm">Remove as Administrator</buton></a>

	@else
	<a href="/demote/{{$user->id}}"><buton class="btn btn-info btn-default btn-sm">Remove as Administrator</buton></a>
	@endif
	@endif
	</div>
</div>
@endforeach

{{$users->links()}}
</div>
@endif
@endsection