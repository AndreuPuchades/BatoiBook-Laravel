<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;


class UsersController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin) {
                $users = User::all();
                return view('users.index', compact('users'));
            }
        }
        abort(403, 'Acceso no autorizado');
    }

    public function delete($id)
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin) {
                $user = User::findOrFail($id);
                $user->delete();
                return redirect()->route('users.index');
            }
        }
        abort(403, 'Acceso no autorizado');
    }
}
