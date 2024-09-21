<?php

namespace App\Livewire\Platform\Auth;

use Livewire\Component;
use App\Actions\Platform\Auth\LoginAction;

class LoginForm extends Component
{
    public $email;

    public $password;

    public $remember = false;

    public function handleLogin(LoginAction $loginAction)
    {
        $loginAction->handle([
            'email' => $this->email,
            'password' => $this->password,
            'remember' => $this->remember,
        ]);

        return redirect('/');
    }

    public function render()
    {
        return view('platform::livewire.auth.login-form');
    }
}
