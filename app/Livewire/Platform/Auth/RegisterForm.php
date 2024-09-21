<?php

namespace App\Livewire\Platform\Auth;

use Livewire\Component;
use App\Actions\Platform\Auth\RegisterAction;
class RegisterForm extends Component
{
    public $first_name;

    public $last_name;

    public $email;

    public $password;

    public $password_confirmation;

    public function handleRegistration(RegisterAction $action)
    {
        $action->create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);

        return redirect()->route('login');
    }

    public function render()
    {
        return view('platform::livewire.auth.register-form');
    }
}
