<?php

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Repository\CalendarRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RetriveAction extends Controller
{
    public function __construct(
        private readonly CalendarRepository $calendarRepository,
    ) {}

    public function __invoke(
        Request $request,
    ): JsonResponse {

        $id = $request->get('id', 0);
        $calendar = $this->calendarRepository->find($id);

        if (!$calendar instanceof Calendar) {
            throw new DomainException('Calendar is not valid');
        }

        return new JsonResponse($calendar);
    }
}
