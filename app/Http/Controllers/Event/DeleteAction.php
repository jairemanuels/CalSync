<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\EventRepository;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;

class DeleteAction extends Controller
{
    public function __construct(
        private EventRepository $eventRepository,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        if (!$request->has('id')) {
            throw new InvalidArgumentException('Not all required parameters are in the request', 404);
        }
        $id = $request->get('id');
        $event = $this->eventRepository->find($id);

        if (!$event instanceof Event) {
            throw new DomainException('Event is not valid');
        }

        $this->eventRepository->delete($event);

        return new JsonResponse([
            'message' => 'Event succesfully deleted',
        ]);
    }
}
