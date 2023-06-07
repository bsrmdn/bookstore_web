<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;

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

// Route::get('/', function () {
//     return view('login');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/authors', function () {
    return view('pages.authors', [
        'authors' => User::all(),
        'books' => Book::all(),
    ]);
});

Route::get('/books', [BookController::class, 'index']);

Route::post('/profile', [BookController::class, 'store'])->middleware('auth');
Route::delete('/profile/{book:slug}', [BookController::class, 'destroy'])->middleware('auth');
Route::put('/profile/{book:slug}', [BookController::class, 'update'])->middleware('auth');
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::get('/profile/{user:username}', [ProfileController::class, 'show']);
Route::get('/profile/{user:username}/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('editProfile');
Route::put('/profile/{user:username}/edit', [ProfileController::class, 'update'])->middleware('auth');
