@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($authors as $author)
            <div class="row mt-4">
                <div class="col-12 d-flex align-items-center mb-4">
                    <div class="overflow-hidden flex-shrink-0 rounded-circle position-relative shadow img-thumbnail"
                        style="height: 5rem; width: 5rem;">
                        <a href="/profile/{{ $author->username }}">
                            <img src="@if ($author->avatar) {{ asset('storage/' . $author->avatar) }} @else{{ asset('img/default-profile.jpg') }} @endif"
                                class="position-absolute h-100 w-auto top-50 start-50 translate-middle" alt="...">
                        </a>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="fw-bold h5"><a href="/profile/{{ $author->username }}"
                                class="text-black link-secondary link-underline-opacity-0 link-underline-opacity-25-hover">{{ $author->name }}</a>
                        </p>
                        <p>made <span class="fw-light">{{ $books->where('user_id', $author->id)->count() }} book(s)</span>
                        </p>
                    </div>
                </div>

                @foreach ($books->where('user_id', $author->id) as $book)
                    <div class="col-auto mb-3">
                        <div class="card border-0 bg-transparent" style="width: 9rem;">
                            <div class="overflow-hidden w-100 position-relative" style="height: 12rem;">
                                <img src="@if ($book->image) {{ asset('storage/' . $book->image) }} @else {{ asset('img/default-book.png') }} @endif"
                                    class="card-img-top position-absolute top-50 start-50 translate-middle" alt="...">
                            </div>
                            <div class="card-body px-0 lh-1">
                                <div class="card-title">
                                    <h5 class="card-title fw-bold fs-6 text-truncate">{{ $book->title }}</h5>
                                    <p class="card-title fw-bold fs-5">Rp. {{ number_format($book->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (!$loop->last)
                <hr>
            @endif
        @endforeach
    </div>
@endsection
