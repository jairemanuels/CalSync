<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\EventRepository;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\Uid\Command\GenerateUuidCommand;

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
            $event->generateUuid();
        }

         if ($request->has('name')){
            $event->name = $request->get('name');
        }

        if ($request->has('description')){
            $event->name = $request->get('description');
        }

        return new JsonResponse($event);

    }
}
