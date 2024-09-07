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
    ):JsonResponse {

        $id = $request->get('id', 0);
        $user = $this->userRepository->find($id);

        if (!$user instanceof User) {
            $user = new User();
            // $user->generateUuid();
        }

        if ($request->has('name')) {
            $user->name = $request->get('name');

        if ($request->has('email')) {
            $user->email = $request->get('email');

        }

        return new JsonResponse($user);


    }

}
}
