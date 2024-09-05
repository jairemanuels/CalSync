<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;
use Google\Client;
use Google\Service\Calendar;


class importEvents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->importEvents();
    }

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

    }
}
