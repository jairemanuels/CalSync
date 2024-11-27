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

        $client = new \Google\Client();
        $client->setApplicationName("Timely");
        $client->setDeveloperKey(config('services.google.client_id'));
        $client->setAccessToken(json_encode($google_client_token));

        $service = new \Google\Service\Calendar($client);

        $allEvents = []; // Opslag voor alle evenementen
        $pageToken = null;

        do {
            $events = $service->events->listEvents($user->email, [
                'maxResults' => 250, // de norm van google
                'pageToken' => $pageToken,
                'singleEvents' => true, // Optioneel, afhankelijk van je usecase tbh
                'orderBy' => 'startTime', // Sorteer op starttijd
            ]);

            $allEvents = array_merge($allEvents, $events->getItems());
            $pageToken = $events->getNextPageToken(); // Volgende pagina-token
        } while ($pageToken);

        foreach ($allEvents as $event) {
            if ($event->start->getDateTime() && $event->end->getDateTime()) {
                Event::updateOrCreate(
                    ['external_id' => $event->id],
                    [
                        'external_id' => $event->id,
                        'user_id' => $user->id,
                        'name' => $event->summary,
                        'description' => $event->description,
                        'event_time_start' => $event->start->getDateTime(),
                        'event_time_end' => $event->end->getDateTime(),
                    ]
                );
            }
        }
    }
}
