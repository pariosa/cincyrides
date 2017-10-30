@extends('layouts.app')
@section('content')
@if(auth()->user()->admin == 1)

<div class="col-md-6 col-md-offset-3">
<div class="col-md-10 col-md-offset-1">
	<div class="col-md-2">
	Event Name
	</div>
	<div class="col-md-4">
	Description
	</div> 
	<div class="col-md-2">
	Creator
	</div>
	<div class="col-md-2">
	Status
	</div>
	<div class="col-md-2">
	Action
	</div>
</div>
@foreach($events as $event)
<div class="col-md-10 col-md-offset-1">
	<div class="col-md-2">
	{{$event->event_name}} 
	</div>
	<div class="col-md-4">
	{{$event->description}}
	</div>
	<div class="col-md-2">
	{{App\User::where('id', $event->event_owner_id)->pluck('name')}}
	</div>
	<div class="col-md-2">
	@if($event->approved == 0)
	Waiting for Approval
	@elseif($event->approved == 1)
	Approved
	@endif
	</div>
	<div class="col-md-2">
	@if($event->approved == 0)
	<a href="/approve/{{$event->id}}""><buton class="btn btn-warning btn-sm">Approve</buton></a>
	@elseif($event->approved == 1)
 
	<a href="/suspend/{{$event->id}}"><buton class="btn btn-info btn-default btn-sm">Suspend</buton></a>
	@endif
	</div>
</div>
@endforeach

{{$events->links()}}
</div>
</div>
@endif
@endsection