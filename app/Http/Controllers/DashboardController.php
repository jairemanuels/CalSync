<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function curWeekCal(Request $request)
    {
        // Get the date from the query string or use the current date
        $date = $request->query('date', now()->format('Y-m-d'));
        $currentDate = Carbon::parse($date);

        // Calculate the start and end of the week based on the current date
        $startTime = $currentDate->startOfWeek()->toDateString();
        $endTime = $currentDate->endOfWeek()->toDateString();
        $previousWeek = $currentDate->copy()->subWeek(1)->format('Y-m-d');
        $nextWeek = $currentDate->copy()->addWeek(1)->format('Y-m-d');

        // Fetch events based on the calculated start and end of the week
        $events = Event::getEventsByDate($startTime, $endTime);


        // Pass the events and the current date to the view
        return view('week-view', [
            'events' => $events,
            'currentDate' => $currentDate,
            'previousWeek' => $previousWeek,
            'nextWeek' => $nextWeek

        ]);
    }

    public function curMonthCal(Request $request)
    {
        // Get the date from the query string or use the current date
        $date = $request->query('date', now()->format('Y-m-d'));
        $currentDate = Carbon::parse($date);

        // Calculate the start and end of the month based on the current date
        $startTime = $currentDate->startOfMonth()->toDateString();
        $endTime = $currentDate->copy()->endOfMonth()->toDateString();
        $previousMonth = $currentDate->copy()->subMonth(1)->format('Y-m-d');
        $nextMonth = $currentDate->copy()->addMonth(1)->format('Y-m-d');

        // Fetch events based on the calculated start and end of the month
        $events = Event::getEventsByDate($startTime, $endTime);
        $calendarStartDate = $currentDate->copy()->startOfMonth();


        for($i = 0; $i < 7; $i++){
            if ($calendarStartDate->dayOfWeek == 1){
                break;
            }
            $calendarStartDate->subDay(1);
        }

        $calendarEndDate = $currentDate->copy()->endOfMonth();

        for($i = 0; $i < 7; $i++){
            if ($calendarEndDate->dayOfWeek == 0){
                break;
            }
            $calendarEndDate->addDay(1);
        }

        // maak array van alle data beginnend vanaf calendar start date
        $days = [];
        for($i = 0; $i < $calendarStartDate->diffInDays($calendarEndDate); $i++){
            $date = $calendarStartDate->copy()->addDay($i);
            $days[] = [
                'date' => $date,
                'events' => $events->filter(function($event) use ($date){
                    return $date->isSameDay($event->event_time_start);
                }),
                'isCurrentMonth' => $date->month == $currentDate->month,
                'isCurrentDay' => $date->isToday()


            ];

        }


        // Pass the events and the current date to the view
        return view('month-view', [
            'calendarStartDate' => $calendarStartDate,
            'events' => $events,
            'currentDate' => $currentDate,
            'previousMonth' => $previousMonth,
            'nextMonth' => $nextMonth,
            'days' => $days
        ]);
    }
}



// class Event extends Model
// {
//     protected $fillable = ['name', 'description', 'start', 'end', 'user_id'];
// }
