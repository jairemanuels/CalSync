<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repository\UserRepository;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RetrieveAction extends Controller
{
    public function __invoke(Request $request): JsonResponse {
        $user = Auth::user();

        if (!$user instanceof User) {
            throw new DomainException('User is not a valid user');
        }

        return new JsonResponse($user);
    }
}
