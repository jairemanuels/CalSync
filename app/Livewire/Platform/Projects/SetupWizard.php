<?php

namespace App\Livewire\Platform\Projects;

use App\Models\Event;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Team;
use App\Models\TeamMember;

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

        $teamMember = TeamMember::create([
            'user_id' => auth()->id(),
            'team_id' => $team->id,
            'role' => 'owner',
        ]);

        // Attach personal events in shared calendar
        $events = Event::where('user_id', auth()->id())->get();
        foreach ($events as $event) {
            $team->event()->attach($event->id, ['user_id' => auth()->id()]);
        }
        
        // Optionally redirect or return a response
        return redirect('/')->with('message', 'Calendar created successfully!');
    }

    public function render()
    {
        return view('platform::livewire.projects.setup-wizard');
    }
}
