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

        // Fetch events based on the calculated start and end of the week
        $events = Event::getEventsByDate($startTime, $endTime);


        // Pass the events and the current date to the view
        return view('week-view', [
            'events' => $events,
            'currentDate' => $currentDate,

        ]);
    }

    public function curMonthCal(Request $request)
    {
        // Get the date from the query string or use the current date
        $date = $request->query('date', now()->format('Y-m-d'));
        $currentDate = Carbon::parse($date);

        // Calculate the start and end of the month based on the current date
        $startTime = $currentDate->startOfMonth()->toDateString();
        $endTime = $currentDate->endOfMonth()->toDateString();

        // Fetch events based on the calculated start and end of the month
        $events = Event::getEventsByDate($startTime, $endTime);

        // Pass the events and the current date to the view
        return view('month-view', [
            'events' => $events,
            'currentDate' => $currentDate,
        ]);
    }
}



// class Event extends Model
// {
//     protected $fillable = ['name', 'description', 'start', 'end', 'user_id'];
// }
