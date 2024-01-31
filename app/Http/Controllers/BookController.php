<?php
namespace App\Http\Controllers;

use App\Mail\PurchaseConfirmationMail;
use App\Models\Book;
use App\Models\Sale;
use App\Models\Module;
use App\Models\User;
use App\Notifications\BookAdmissionNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SalesController;

class BookController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->isAdmin) {
                $books = Book::paginate(10);
            } else {
                $books = Book::whereNull('soldDate')->where('user_id', Auth::id())->where('admit', 1)->paginate(10);
            }
            return view('book.index', compact('books'));
        } else {
            $books = Book::whereNull('soldDate')->where('admit', 1)->paginate(10);
            return view('book.allBooks', compact('books'));
        }
    }

    public function allBooks()
    {
        if (Auth::check()) {
            $books = Book::whereNull('soldDate')->where('admit', 1)->paginate(10);
            return view('book.allBooks', compact('books'));
        }
        abort(403, 'Acceso no autorizado');
    }

    public function buy($id)
    {
        if (Auth::check()) {
            $book = Book::find($id);
            $user = User::find($book->user_id);

            if ($book->soldDate === null) {
                $book->update(['soldDate' => Carbon::now()]);

                app(SalesController::class)->store(request()->merge([
                    'idBook' => $book->id,
                    'idUser' => $user->id,
                    'date' => Carbon::now(),
                    'status' => 1,
                ]));

                Mail::to($user->email)->send(new PurchaseConfirmationMail($book));
            }

            return redirect()->route('book.index');
        }

        abort(403, 'Acceso no autorizado');
    }

    public function sales()
    {
        if (Auth::check()) {
            $user = auth()->user();

            if ($user->isAdmin) {
                $sales = Sale::all();
            } else {
                $sales = Sale::where('idUser', $user->id)->get();
            }
            return view('book.sales', compact('sales'));
        } else {
            $books = Book::whereNull('soldDate')->paginate(10);
            return view('book.index', compact('books'));
        }
    }

    public function delete($id)
    {
        if (Auth::check()){
            $book = Book::findOrFail($id);
            $book->delete();
        }
        return redirect()->route('book.index');
    }

    public function showById($id)
    {
        $book = Book::findOrFail($id);

        return view('book.show', ['book' => $book]);
    }

    public function edit($id)
    {
        if (Auth::check()){
            $modules = Module::all();
            $book = Book::findOrFail($id);
            return view('book.edit', compact('modules', 'book'));
        } else {
            return redirect()->route('book.index');
        }
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

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

        return redirect()->route('book.index');
    }

    public function new()
    {
        if (Auth::check()) {
            $modules = Module::all();
            return view('book.new', compact('modules'));
        } else {
            return redirect()->route('book.index');
        }
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

        $admin = User::where('isAdmin', true)->first();
        if ($admin) {
            $admin->notify(new BookAdmissionNotification($book));
        }
        return redirect()->route('book.index');
    }

    public function admit($id)
    {
        $book = Book::findOrFail($id);
        if ($book->admit == 0) {
            $book->admit = 1;
            $book->save();
        }
        return redirect()->route('book.index');
    }
}
