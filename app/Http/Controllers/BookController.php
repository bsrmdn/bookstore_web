<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
// use App\Http\Requests\StoreBookRequest;
// use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.books', [
            'books' => Book::all(),
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
            'image' => 'image|file',
            'title' => 'required',
            'price' => 'required'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('book-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Book::create($validatedData);

        return redirect('/profile')->with('success', 'Your book has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
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
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'image|file',
            'price' => 'required'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('book-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Book::where('id', $book->id)->update($validatedData);

        return redirect('/profile')->with('success', 'Your book has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // return dd($book->id);
        Book::destroy($book->id);
        // $book->destroy($book->id);

        return redirect('/profile')->with('success', 'Your book has been deleted!');
    }
}
