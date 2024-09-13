<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'uuid',
        'external_id',
        'name',
        'description',
        'event_time_start',
        'event_time_end',
    ];

    function calculateGridPosition($startTime, $endTime)
    {
        $start = Carbon::parse($startTime);
        $end = Carbon::parse($endTime);

        // Assuming grid starts at 12:00 AM
        $startRow = $start->hour * 12 + ceil($start->minute / 5) + 2; // Each row represents 5 minutes
        $endRow = $end->hour * 12 + ceil($end->minute / 5) + 2;
        $span = $endRow - $startRow;

        return [
            'start' => $startRow,
            'span' => $span,
            'day' => $start->dayOfWeek + 1 // +1 because Tailwind UI starts the week on Sunday (1)
        ];
    }

    static function getEventsByDate($startTime, $endTime)
    {

        return Event::where('event_time_start', '>=', $startTime)
            ->where('event_time_end', '<=', $endTime)
            ->get();
    }
}
