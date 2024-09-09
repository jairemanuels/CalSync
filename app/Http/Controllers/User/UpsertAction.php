<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\UserRepository;
use DomainException;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Js;

class UpsertAction extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {}

    // Creer nieuwe user:
    // 1. Haal de user op uit de request
    // 2. Sla de user op in de database

    public function __invoke(
        Request $request,
    ): JsonResponse {
        $id = $request->get('id', 0);

        $user = $this->userRepository->find($id);

        if (!$user instanceof User) {
            $user = new User();
            $user->uuid = $user->generateUuid();
        }

        if (!$request->has('name')) {
            throw new DomainException('Name is not in the request');
        }

        $name = $request->get('name');

        if (
            is_string($name)
            && $name !== ''
        ) {
            throw new DomainException('User can not have an empty name');
        }

        if (!$request->has('email')) {
            throw new DomainException('Email is not in the request');
        }

        $email = $request->get('email');

        if (
            is_string($email)
            && $email !== ''
        ) {
            throw new DomainException('User can not have an empty email');
        }

        $user->name = $name;
        $user->email = $email;

        $this->userRepository->save($user);

        return new JsonResponse($user);
    }
}
