<?php

namespace App\Actions\Platform\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    /**
     * Handle user login on the platform
     *
     * @throws ValidationException
     */
    public function handle(array $input)
    {
        $validated = $this->validate($input);

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $validated['remember'] ?? false)) {
            return;
        } else {
            throw ValidationException::withMessages([
                'password' => 'Email or password is incorrect',
            ]);
        }
    }

    /**
     * Validate user input
     *
     * @throws ValidationException
     */
    private function validate(array $input)
    {
        return Validator::make($input, [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', 'max:255'],
            'remember' => ['nullable', 'boolean'],
        ])->validate();
    }
}
