<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Book;

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

Route::get('users/{author:name}', function (User $author) {
    return view('profile', [
        'author' => $author->name,
        'books' => Book::all(),

    ]);
});
Route::get('/profile', function () {
    return view('profile', [
        'books' => Book::all(),
        'myBooks' => Book::where('user_id', auth()->user()->id)->get()
    ]);
})->name('profile');
