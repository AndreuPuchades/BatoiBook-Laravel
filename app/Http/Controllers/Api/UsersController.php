<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::all(['id', 'name', 'email', 'isAdmin']);
        return response()->json($users, 200);
    }
}
