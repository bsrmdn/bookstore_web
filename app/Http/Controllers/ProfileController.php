<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile', [
            'author' => auth()->user()->name,
            'myBooks' => Book::where('user_id', auth()->user()->id)->get(),
            'purchasedBooks' => Book::where('user_id', '!=', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'price' => 'required'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        Book::create($validatedData);

        return redirect('/profile')->with('success', 'Your book has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
        // if ($username == auth()->user()->username) {
        //     return redirect('/profile');
        // } else {
        //     return view('profile', [
        //         'author' => $username->username,

        //     ]);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // return dd($book);
        Book::destroy($book->id);
        // $book->destroy($book->id);

        return redirect('/profile')->with('success', 'Your book has been deleted!');
    }
}
