<?php

namespace App\Http\Controllers;

use App\Http\Platform\Controllers\TeamFetch;
use App\Models\Event;
use App\Models\Team;
use Google\Client;
use Google\Service\Calendar;
use Illuminate\Support\Facades\View;

class GoogleEventsController extends Controller
{

    public function importEvents()
    {
        $user = auth()->user();


        $google_client_token = [
            'access_token' => $user->provider_token,
            'refresh_token' => $user->refresh_token,
            'expires_in' => $user->expires_in,
        ];



        $client = new Client();
        $client->setApplicationName("Timely");
        $client->setDeveloperKey(config('services.google.client_id'));
        $client->setAccessToken(json_encode($google_client_token));

        $service = new Calendar($client);

        $events = $service->events->listEvents($user->email);

        /** @var Event $event */
        $events = $events->getItems();

        foreach ($events as $event) {
            if ($event->start?->getDateTime() && $event->end?->getDateTime()) {
                if (! Event::where(['external_id' => $event->id])->exists()) {
                    Event::updateOrCreate([
                        'external_id' => $event->id,
                        'user_id' => $user->id,
                        'name' => $event->summary,
                        'description' => $event->description,
                        'event_time_start' => $event->start->getDateTime(),
                        'event_time_end' => $event->end->getDateTime(),
                    ]);
                }
            }
        }


    }
}
