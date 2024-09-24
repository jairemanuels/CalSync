<?php

namespace App\Actions\Platform\Events;

use App\Models\Event;
use App\Models\Tenant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateEventAction
{
    /**
     * Handle user registration on the platform
     *
     * @throws ValidationException
     */
    public function create(Tenant $tenant, array $input): Event
    {
        $validated = $this->validate($tenant, $input);

        $validated['tenant_id'] = $tenant->id;
        return Event::create($validated);
    }

    /**
     * Validate user input
     *
     * @throws ValidationException
     */
    public function validate(Tenant $tenant, array $input)
    {
        if(!$tenant) {
            throw ValidationException::withMessages([
                'tenant' => 'Tenant not found',
            ]);
        }

        return Validator::make($input, [
            'user_id' => ['required', 'exists:users,id'],
            'description' => ['required', 'string'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date'],
            'all_day' => ['required', 'boolean'],
            'color' => ['required', 'string'],
        ])->validate();
    }
}
