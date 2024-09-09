<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Repository\EventRepository;
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

        $event = $this->eventRepository->all();
        return new JsonResponse($event);
    }
}
