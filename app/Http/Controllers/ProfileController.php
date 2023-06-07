<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.profile', [
            'author' => auth()->user(),
            'myBooks' => Book::where('user_id', auth()->user()->id)->get(),
            'purchasedBooks' => Book::where('user_id', '!=', auth()->user()->id)->get(),
            'isMyProfile' => true,
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
        // $validatedData = $request->validate([
        //     'image' => 'image|file',
        //     'title' => 'required',
        //     'price' => 'required'
        // ]);

        // if ($request->file('image')) {
        //     $validatedData['image'] = $request->file('image')->store('book-images');
        // }

        // $validatedData['user_id'] = auth()->user()->id;

        // Book::create($validatedData);

        // return redirect('/profile')->with('success', 'Your book has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if ($user == auth()->user()) {
            return redirect('/profile');
        } else {
            return view('pages.profile', [
                'author' => $user,
                'myBooks' => Book::all()->where('user_id', $user->id),
                'isMyProfile' => false,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.profile', [
            'author' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'avatar' => 'image|file',
        ]);

        if ($request->file('avatar')) {
            $validatedData['avatar'] = $request->file('avatar')->store('user-avatars');
        }

        $validatedData['username'] = Str::slug($validatedData['name']);


        User::where('id', $user->id)->update($validatedData);

        return redirect('/profile')->with('success', 'Your profile has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
    }
}
