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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

// Route::get('/profile/{user:username}', function (User $user) {
//     return view('profile', [
//         'author' => $user->username,
//         'books' => Book::all(),

//     ]);
// });
// Route::delete('/profile/{slug}', [ProfileController::class, 'destroy'])->middleware('auth');
Route::resource('/profile', ProfileController::class)->middleware('auth')->names([
    'index' => 'profile',
]);
