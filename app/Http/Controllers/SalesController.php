<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Sale;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idBook' => 'required|exists:books,id',
            'idUser' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required',
        ]);

        Sale::create($validatedData);

        return redirect()->route('sales.index');
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);

        $validatedData = $request->validate([
            'idBook' => 'required|exists:books,id',
            'idUser' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required',
        ]);

        $sale->update($validatedData);

        return redirect()->route('sales.index');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return redirect()->route('sales.index');
    }
}
