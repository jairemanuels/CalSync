<?php

namespace App\Livewire\Platform\Projects;

use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Actions\Platform\Setup\CreateTenantAction;

class SetupWizard extends Component
{
    public $name = '';

    public $domain = '';

    public $timezone = 'Europe/Amsterdam';

    public $language = 'en';

    public $clock = '24';

    public $address = '';

    public $address2 = '';

    public $country = 'NL';

    public $region = '';

    public $city = '';

    public $zip_code = '';

    public function createTenant(CreateTenantAction $createTenantAction)
    {
        $createTenantAction->create(auth()->user(), [
            'name' => $this->name,
            'domain' => $this->domain,
            'timezone' => $this->timezone,
            'language' => $this->language,
            'country' => $this->country,
            'clock' => $this->clock,
            'address' => $this->address,
            'address2' => $this->address2,
            'region' => $this->region,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
        ]);

        $this->redirect('/');
    }

    public function render()
    {
        return view('platform::livewire.projects.setup-wizard');
    }
}
