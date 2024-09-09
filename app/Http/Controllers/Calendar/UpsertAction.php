<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Repository\CalendarRepository;
use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpsertAction extends Controller
{

    // kijk of user bestaat
    // zo ja, geeft user terug
    // zo nee, maak nieuwe user aan met Uuid

    public function __construct(
        private CalendarRepository $calendarRepository,
    ) {}

    public function __invoke(
        Request $request,
    ): JsonResponse {

        $id = $request->get('id', 0);
        $calendar = $this->calendarRepository->find($id);

        if (!$calendar instanceof Calendar) {
            $calendar = new Calendar();
            $calendar->generateUuid();
        }

        if ($request->has('name')) {
            $calendar->name = $request->get('name');
        }

        if ($request->has('slug')) {
            $calendar->email = $request->get('slug');
        }

        return new JsonResponse($calendar);
    }
}
