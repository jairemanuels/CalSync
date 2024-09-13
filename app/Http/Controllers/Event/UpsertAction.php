<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\EventRepository;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpsertAction extends Controller
{

    public function __construct(
        private readonly EventRepository $eventRepository,
    ) {}

    public function __invoke(
        Request $request,
    ): JsonResponse {

        $id = $request->get('id', 0);
        $event = $this->eventRepository->find($id);

        if (!$event instanceof Event) {
            $event = new Event();
            $event->uuid = $event->generateUuid();
        }

        if (!$request->has('name')) {
            throw new DomainException('Name is not in the request');
        }

        $name = $request->get('name');

        if (
            is_string($name)
            && $name !== ''
        ) {
            throw new DomainException('Event can not have an empty name');
        }

        if (!$request->has('description')) {
            throw new DomainException('Description is not in the request');
        }

        $description = $request->get('description');

        if (
            is_string($description)
            && $description !== ''
        ) {
            throw new DomainException('Name must be a valid string');
        }

        if (!$request->has('start')) {
            throw new DomainException('Starttime is not in the request');
        }

        if (!$request->has('end')) {
            throw new DomainException('Endtime is not in the request');
        }

        $event->name = $name;
        $event->description = $description;
        $event->start = $request->get('start');
        $event->end = $request->get('end');

        $this->eventRepository->save($event);

        return new JsonResponse($event);
    }
}
