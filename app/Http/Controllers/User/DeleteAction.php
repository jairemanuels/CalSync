<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\UserRepository;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;

class DeleteAction extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
    )
    {}

    public function __invoke(Request $request): JsonResponse
    {
        if (!$request->has('user_id')){
            throw new InvalidArgumentException('Not all required parameters are in the request', 404);
        }

        $userId = $request->get('user_id');

        $user = $this->userRepository->find($userId);

        if (!$user instanceof User) {
            throw new DomainException('User is not a valid user', 404);
        }

        $this->userRepository->delete($user);

        return new JsonResponse([
            'message' => 'User succesfully deleted',
        ]);
    }


}
