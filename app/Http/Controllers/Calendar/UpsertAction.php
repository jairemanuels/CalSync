<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Repository\CalendarRepository;
use App\Repository\UserRepository;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;

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


        if (!$request->has('name')) {
            throw new InvalidArgumentException('Name is not in the request');
        }

        $name = $request->get('name');

        if (
            is_string($name)
            && $name !== ''
        ) {
            throw new DomainException('Name must be a valid string');
        }

        $calendar->name = $name;

        $this->calendarRepository->save($calendar);

        return new JsonResponse($calendar);
    }
}
