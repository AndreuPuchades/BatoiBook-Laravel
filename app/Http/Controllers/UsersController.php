<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UsersController extends Controller
{
    public function index(): View
    {
        if (Auth::check() && Auth::user()->isAdmin) {
            $users = User::all();
            return view('users.index', compact('users'));
        }

        abort(403, 'Acceso no autorizado');
    }

    public function delete($id): RedirectResponse
    {
        if (Auth::check() && Auth::user()->isAdmin) {
            $user = User::findOrFail($id);
            $user->delete();

            return Redirect::route('users.index');
        }

        abort(403, 'Acceso no autorizado');
    }
}
