<?php

namespace App\Livewire\Platform\Auth;

use Livewire\Component;
use App\Actions\Platform\Auth\RegisterAction;
class RegisterForm extends Component
{
    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public function handleRegistration(RegisterAction $action)
    {
        $action->create([
            'name' => $this->name,
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
