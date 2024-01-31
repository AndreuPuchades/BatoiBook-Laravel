<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('user')->paginate(10);
        return new BookCollection($books);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'module_id' => 'required|exists:modules,code',
            'publisher' => 'required|string',
            'price' => 'required|numeric',
            'pages' => 'required|numeric',
            'status' => 'required|string',
            'photo' => 'required|image',
            'comments' => 'nullable|string',
        ]);
        if($request->hasFile('photo')){
            $path =  $request->file('photo')->store('public/books');
            $validatedData['photo'] = Storage::url($path);
        }
        $validatedData['user_id'] = Auth::id();
        $book = new Book($validatedData);
        $book->save();
        return response()->json($book, 201);
    }

    public function show(Book $books)
    {
        return new BookResource($books);
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'module_id' => 'required|exists:modules,code',
            'publisher' => 'required|string',
            'price' => 'required|numeric',
            'pages' => 'required|numeric',
            'status' => 'required|string',
            'photo' => 'nullable|image',
            'comments' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/books');
            $validatedData['photo'] = Storage::url($path);
        }

        $book->update($validatedData);

        return response()->json($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Venta eliminada con éxito']);
    }
}
