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
            '#1B1B2F', '#2F3E46', '#4D4D4D', '#8A8A8A', '#ABB2B9', '#77665E', '#ADA9A3', '#2C3E50', '#85929E'
        ];

        $palette2 = [
            "#582f0e","#7f4f24","#936639","#a68a64","#b6ad90","#c2c5aa","#a4ac86","#656d4a","#414833","#333d29"
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
