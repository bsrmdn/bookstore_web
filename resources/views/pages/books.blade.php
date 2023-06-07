@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between my-5">
            @foreach ($books->sortBy('title') as $book)
                <div class="col-auto mb-3">
                    <div class="card border-0 bg-transparent" style="width: 16rem;">
                        <div class="overflow-hidden w-100 position-relative" style="height: 19rem;">
                            <img src="@if ($book->image) {{ asset('storage/' . $book->image) }} @else {{ asset('img/default-book.png') }} @endif"
                                class="card-img-top position-absolute top-50 start-50 translate-middle" alt="...">
                        </div>
                        <div class="card-body px-0 lh-1">
                            <div class="row card-title justify-content-between">
                                <div class="col-6">
                                    <h5 class="card-title fw-bold fs-6 text-truncate">{{ $book->title }}</h5>
                                </div>
                                <div class="col-auto text-end">
                                    <p class="card-title fw-bold fs-5">Rp. {{ number_format($book->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <p class="card-text fs-6">by: <a href="/profile/{{ $book->user->username }}"
                                    class="card-text fs-6 text-decoration-none text-black">
                                    {{ $book->user->name }}</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
