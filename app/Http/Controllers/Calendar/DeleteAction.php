<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Repository\CalendarRepository;
use App\Repository\UserRepository;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteAction extends Controller
{
    public function __construct(
        private CalendarRepository $calendarRepository,
        ) {}

    public function __invoke(
        Request $request,
    ): JsonResponse {

        $id = $request->get('id', 0);
        $calendar = $this->calendarRepository->find($id);

        if (!$calendar instanceof Calendar) {
            throw new DomainException('Calendar is not a valid calendar');
        }

        $this->calendarRepository->delete($calendar);
        return new JsonResponse($calendar);
    }
}
