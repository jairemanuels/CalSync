<?php

namespace App\Livewire\Platform\Projects;

use App\Models\Event;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Team;
use App\Models\TeamEvents;
use App\Models\TeamMember;
use App\Services\teamMemberService;

class SetupWizard extends Component
{
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('nullable|max:255')]
    public $description = '';

    #[Validate('required')]
    public $private = true;

    #[Validate('required')]
    public $collaborative = false;

    #[Validate('required')]
    public $timezone = 'Europe/Amsterdam';

    #[Validate('required')]
    public $clock = '24';

    public function generateColor($teamId)
    {

        $usedColors = TeamMember::where('team_id', $teamId)->pluck('color')->filter();

        $palette = [
            "#c4cea1","#d9e0a3","#fdf2b0","#f3d17c","#cf9963"
        ];

        $palette2 = [
            "#ffc8dd","#ffafcc","#bdb2ff","#bde0fe","#a2d2ff"
        ];

        $availableColors = collect($palette)->diff($usedColors);

        if ($availableColors->isEmpty()) {
            $availableColors = collect($palette2);
        }

        return $availableColors->random();
    }

    public function createTeamCalendar()
    {
        $this->validate();

        $team = Team::create([
            'name' => $this->name,
            'description' => $this->description,
            'is_private' => $this->private,
            'is_collaborative' => $this->collaborative,
            'owner_id' => auth()->id(),
        ]);

        $teamId = $team->id;
        $color = $this->generateColor($teamId);


        TeamMember::create([
            'user_id' => auth()->id(),
            'team_id' => $team->id,
            'role' => 'owner',
            'color' => $color,
        ]);

        foreach (auth()->user()->events as $event) {
            TeamEvents::create([
                'team_id' => $teamId,
                'event_id' => $event->id,
                'color' => $color,
                'user_id' => auth()->id(),
            ]);
        }

        // // Attach personal events in shared calendar
        // $events = Event::where('user_id', auth()->id())->get();
        // foreach ($events as $event) {
        //     $team->event()->attach($event->id, [
        //         'user_id' => auth()->id(),
        //         'color' => $color,
        //     ]);
        // }

        // Optionally redirect or return a response
        return redirect('/')->with('message', 'Calendar created successfully!');
    }

    public function render()
    {
        return view('platform::livewire.projects.setup-wizard');
    }
}
