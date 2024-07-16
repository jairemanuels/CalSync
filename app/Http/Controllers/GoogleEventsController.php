<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\EventDateTime;
use Illuminate\Http\Request;

class GoogleEventsController extends Controller
{

    public function importEvents()
    {
        $userProvider = auth()->user()->userProviders->last()->first();

        $google_client_token = [
            'access_token' => $userProvider->provider_token,
            'refresh_token' => $userProvider->provider_refresh_token,
            'expires_in' => $userProvider->provider_expires_in
        ];

        $client = new Client();
        $client->setApplicationName("Timely");
        $client->setDeveloperKey(config('services.google.client_id'));
        $client->setAccessToken(json_encode($google_client_token));

        $service = new Calendar($client);

        $events = $service->events->listEvents(auth()->user()->email);

        /** @var Event $event */
        $events = $events->getItems();

        foreach ($events as $event) {
            if (! Event::where(['external_id' => $event->id])->exists()){
                Event::create([
                    'external_id' => $event->id,
                    'user_id' => auth()->user()->id,
                    'name' => $event->summary,
                    'description' => $event->description,
                    'event_time_start' => $event->start?->getDateTime(),
                    'event_time_end' => $event->end?->getDateTime(),
                ]);
            }
        }

        redirect('/week-view');
        
    }
}
