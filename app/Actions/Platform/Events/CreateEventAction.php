<?php

namespace App\Actions\Platform\Events;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateEventAction
{
    /**
     * Handle user registration on the platform
     *
     * @throws ValidationException
     */
    public function create(array $input): Event
    {
        $user = auth()->user();
        $validated = $this->validate($user, $input);

        $validated['user_id'] = $user->id;
        return Event::create($validated);
    }

    /**
     * Validate user input
     *
     * @throws ValidationException
     */
    public function validate($user, array $input)
    {
        if(!$user = auth()->user()) {
            throw ValidationException::withMessages([
                'User' => 'Please login to create an event',
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
