<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Repository\CalendarRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListAction extends Controller
{
    public function __construct(
        private CalendarRepository $calendarRepository,
        ) {}

    public function __invoke(Request $request) : JsonResponse
    {
        $calendars = $this->calendarRepository->all();
        return new JsonResponse($calendars);
    }
}
