<?php

namespace App\Http\Controllers\User;

use DomainException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class LoginAction extends Controller
{
    private const MINIMAL_LENGTH_OF_PASSWORD = 6;

    public function __construct() {
        // TODO:code
    }

    public function __invoke(Request $request) {
        // 1.Data ophalen van wat de gebruiker verstuurd => Request
        if (
            !$request->has('email')
            || !$request->has('password')
        ) {
            throw new InvalidArgumentException('Required parameters aren\'t passed.');
        }
        // Valideren of data correct is
        $email = $request->get('email');
        $password = $request->get('password');

        if (!is_string($email)) {
            throw new DomainException('Email must be a valid string');
        }

        if (
            !is_string($password)
            || strlen($password) < self::MINIMAL_LENGTH_OF_PASSWORD
        ) {
            throw new DomainException('Email must be a valid string');
        }
        // 2.Authenticeren
        if(Auth::attempt([$email, $password], false)){
            dd('connected');
        } else {
            dd('not connected');
        }
        // 3. Doorverwezen wordt naar /week-view
    }
}
