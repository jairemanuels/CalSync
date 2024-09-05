<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ListAction extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {}

    public function __invoke(Request $request)
    {
        $users = $this->userRepository->all();
        return new JsonResponse($users);
    }
}
