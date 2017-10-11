<?php

namespace App\Http\Controllers;

use App\event;
use Illuminate\Http\Request;

class calendarController extends Controller
{
    //


    public function current(){

        $month = date("m");
        $year= date("Y"); 
        $daysInMonth= cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $first= date('01-m-Y');
        $firstDate = date('d',  strtotime($first));
        $firstDay=  jddayofweek(cal_to_jd(CAL_GREGORIAN, $month, $firstDate,  $year), 1);
        $offset = 0;
        switch ($firstDay){
            case "Sunday":
            $offset = 0;
            break;
            case "Monday":
            $offset = 1;
            break;
            case "Tuesday":
            $offset = 2;
            break;
            case "Wednesday":
            $offset = 3;
            break;
            case "Thursday":
            $offset = 4;
            break;
            case "Friday":
            $offset = 5;
            break;
            case "Saturday":
            $offset = 6;
            break;
        } 
        $events = event::whereYear('date', date($year))->whereMonth('date', date($month))->get();
        //dd($events);
                $with = ["month" =>$month,
                 "year" => $year,
                 "days" => $daysInMonth,
                 "first" => $firstDay,
                 "offset" => $offset,
                 "events" => $events
                ];
        return view('calendar')->with($with);
    }


    
    public function index($month, $year){
    	$daysInMonth= cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $first= date('01-m-Y');
        $firstDate = date('d', strtotime($first));
        $firstDay=  jddayofweek(cal_to_jd(CAL_GREGORIAN, $month, $firstDate,  $year), 1);
        $offset = 0;
        switch ($firstDay){
            case "Sunday":
            $offset = 0;
            break;
            case "Monday":
            $offset = 1;
            break;
            case "Tuesday":
            $offset = 2;
            break;
            case "Wednesday":
            $offset = 3;
            break;
            case "Thursday":
            $offset = 4;
            break;
            case "Friday":
            $offset = 5;
            break;
            case "Saturday":
            $offset = 6;
            break;
        }
        $events = event::where('approved', '=', 1)->whereYear('date', date($year))->whereMonth('date', date($month))->get();
    	$with = ["month" =>$month,
    			 "year" => $year,
                 "days" => $daysInMonth,
                 "first" => $firstDay,
                 "offset" => $offset,
                 "events" => $events,

    			];
    	return view('calendar')->with($with);
    }
}
