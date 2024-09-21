<?php

namespace App\Actions\Platform\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class RegisterAction
{
    /**
     * Handle user login on the platform
     *
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        $validated = $this->validate($input);

        try {
            $validated['password'] = Hash::make($validated['password']);
            return User::create($validated);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'Something went wrong, please try again',
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
            'first_name' => ['required', 'string', 'min:2', 'max:50'],
            'last_name' => ['required', 'string', 'min:2', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:5', 'max:255', 'confirmed'],
        ])->validate();
    }
}
