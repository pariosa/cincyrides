@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="/css/calendar.css">
	<div class="backward col-md-3 col-xs-3 col-sm-3">
		@if(($offset >= 5 && $days > 30) || ($offset > 5 &&  $days > 29)) 
		<style> @media (min-width: 992px) {.calendar{height:800px;}}</style>
		@endif
		@if($month != 1)
		<a href="/calendar/{{$month - 1 }}/{{$year}}"> <</a>
		@else
		<a href="/calendar/12/{{$year - 1}}"><</a>
		@endif
		</div>
	<div class="month col-md-6 col-xs-6  col-sm-6">
		{{DateTime::createFromFormat('!m', $month)->format('F')}}
		{{$year}}
	</div>
	<div class="forward col-md-3 col-xs-3 col-sm-3">
		@if($month != 12)
		<a href="/calendar/{{$month + 1 }}/{{$year}}">></a>
		@else
		<a href="/calendar/1/{{$year + 1}}">></a>
		@endif
	</div>
<div class='col-md-10 col-md-offset-1 calendar'>
	<div class="row seven-cols calendar-inner">
		<div class='calendar-header hidden-sm  hidden-xs'>
			<div class="col-md-1 day-header hidden-sm hidden-xs">Sunday</div>
			<div class="col-md-1 day-header hidden-sm hidden-xs">Monday</div>
			<div class="col-md-1 day-header hidden-sm hidden-xs">Tuesday</div>
			<div class="col-md-1 day-header hidden-sm hidden-xs">Wednesday</div>
			<div class="col-md-1 day-header hidden-sm hidden-xs">Thursday</div>
			<div class="col-md-1 day-header hidden-sm hidden-xs">Friday</div>
			<div class="col-md-1 day-header hidden-sm hidden-xs">Saturday</div>
 		</div>
		@for($x = 0; $x < $offset; $x++)
			<div class="col-md-1 day hidden-xs hidden-sm">
			</div>
		@endfor
		@for($x = 1; $x <= $days; $x++)
			<div class="col-md-1  day">
				{{$x}}
					@foreach($events as $item) 
						@if(explode('-',$item->date,$month )[2] == $x)
						@if($item->approved == 1)
						<a href="/event/{{$item->id}}">{{$item->event_name}}</a>
						@endif
						@endif 
				@endforeach
			</div>
		@endfor
	</div>
</div>
@endsection