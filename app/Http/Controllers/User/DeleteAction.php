<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\UserRepository;
use DomainException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteAction extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
    )
    {}

    public function __invoke()
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            throw new DomainException('User is not a valid user');
        }
        $this->userRepository->delete($user);
        return redirect('/');
    }


}
