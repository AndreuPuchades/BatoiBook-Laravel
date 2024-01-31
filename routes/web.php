<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/books', [BookController::class, 'index'])->name('book.index');
Route::get('/allBooks', [BookController::class, 'allBooks'])->name('book.allBooks');
Route::get('/book/{id}', [BookController::class, 'showById'])->name('book.show');
Route::get('/delete/{id}', [BookController::class, 'delete'])->name('book.delete');
Route::get('/buy/{id}', [BookController::class, 'buy'])->name('book.buy');

Route::get('/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
Route::put('/updateBook/{id}', [BookController::class, 'update'])->name('book.update');

Route::get('/new', [BookController::class, 'new'])->name('book.new');
Route::post('/addBook', [BookController::class, 'store'])->name('book.store');

Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');

Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UsersController::class, 'delete'])->name('users.delete');

Route::get('/admit/{id}', [BookController::class, 'admit'])->name('book.admit');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
