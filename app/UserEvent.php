<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
   	protected $table = 'user_events';
	protected $fillable = ['userID', 'eventID'];

	
}
