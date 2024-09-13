<?php

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Repository\CalendarRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RetrieveAction extends Controller
{
    public function __construct(
        private readonly CalendarRepository $calendarRepository,
    ) {}

    public function __invoke(
        Request $request,
    ): JsonResponse {

        if (!$request->has('id')) {
            throw new InvalidArgumentException('Not all required parameters are in the request', 404);
        }

        $id = $request->get('id', 0);
        $calendar = $this->calendarRepository->find($id);

        if (!$calendar instanceof Calendar) {
            throw new DomainException('Calendar is not valid');
        }

        return new JsonResponse($calendar);
    }
}
