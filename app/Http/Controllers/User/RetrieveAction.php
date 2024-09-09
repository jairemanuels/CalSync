<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repository\UserRepository;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class RetrieveAction extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ){}

    public function __invoke(Request $request): JsonResponse {
        if (!$request->has('user_id')) {
            throw new InvalidArgumentException('Request does not have the required parameters');
        }

        $userId = $request->get('user_id');
        $user = $this->userRepository->find($userId);

        if (!$user instanceof User) {
            throw new DomainException('User is not a valid user');
        }

        return new JsonResponse($user);
    }
}
