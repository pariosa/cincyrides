<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
	protected $table = 'events';
	protected $fillable = ['event_name', 'date', 'strava_link','location', 'approved', 'category_id', 'description', 'image', 'event_owner_id'];
}
