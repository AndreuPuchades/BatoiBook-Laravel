<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = auth()->user();

            if ($user->isAdmin) {
                $sales = Sale::all();
            } else {
                $sales = Sale::where('idUser', $user->id)->get();
            }
            return view('sales.index', compact('sales'));
        } else {
            $books = Book::whereNull('soldDate')->paginate(10);
            return view('sales.index', compact('books'));
        }
    }
}
