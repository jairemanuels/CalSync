<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\EventRepository;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteAction extends Controller
{
    public function __construct(
        private EventRepository $eventRepository,
        ) {}

    public function __invoke(
        Request $request,
    ): JsonResponse {

        $id = $request->get('id', 0);
        $event = $this->eventRepository->find($id);

        if (!$event instanceof Event) {
            throw new DomainException('Event is not valid');
        }

        $this->eventRepository->delete($event);
        return new JsonResponse($event);
    }
}
