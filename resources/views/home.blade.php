@extends('layouts.app')

@section('content')
    <section class="hero-page">
        <div class="container h-100">
            <div class="row h-100 align-content-center justify-content-md-between">
                <div class="col">
                    <h1 class="hero-title fw-bolder">Find Your <br>Next Book</h1>
                    <p>Our most popular and trending <b>Book.Store</b> perfect<br>
                        Not sure what to read now next reading mood Perfectly</p>
                    <a href="#bestSellers" type="button" class="btn btn-secondary btn-lg rounded-0 px-5 mt-1">Explone Now</a>
                </div>
                @foreach ($books->except('user_id', auth()->user()->id)->shuffle()->take(3) as $book)
                    @if ($loop->iteration % 2)
                        <div class="col-auto align-self-center d-lg-block d-none">
                            <div class="card border-0 bg-transparent text-center" style="width: 10rem;">
                                <div class="overflow-hidden w-100 position-relative rounded-bottom rounded-pill"
                                    style="height: 20rem;">
                                    <img src="{{ asset('img/thus-spoke-zarathustra.jpg') }}"
                                        class="card-img-top position-absolute top-50 start-50 translate-middle h-100"
                                        alt="...">
                                </div>
                                <div class="card-body px-0 lh-1">
                                    <div class="row card-title">
                                        <h5 class="card-title fw-bold fs-6 text-truncate">{{ $book->title }}</h5>
                                    </div>
                                    <p class="card-text fs-6">{{ $book->user->name }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-auto align-self-center d-xl-block d-none">
                            <div class="card border-0 bg-transparent text-center" style="width: 10rem;">
                                <div class="card-body px-0 lh-1">
                                    <div class="row card-title">
                                        <h5 class="card-title fw-bold fs-6 text-truncate">{{ $book->title }}</h5>
                                    </div>
                                    <p class="card-text fs-6">{{ $book->user->name }}</p>
                                </div>
                                <div class="overflow-hidden w-100 position-relative rounded-top rounded-pill"
                                    style="height: 20rem;">
                                    <img src="{{ asset('img/thus-spoke-zarathustra.jpg') }}"
                                        class="card-img-top position-absolute top-50 start-50 translate-middle h-100"
                                        alt="...">
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </section>

    <section class="container d-flex" id="bestSellers">
        <div class="my-auto">
            <div class="row justify-content-between mt-2">
                <div class="col-12 d-flex mb-3 align-items-end">
                    <h2 class="fw-bolder flex-fill">BestSellers</h2>
                    <span class="small align-text-bottom">See All</span>
                </div>
                @foreach ($books->shuffle()->take(4) as $book)
                    <div class="col-auto">
                        <div class="card border-0 bg-transparent" style="width: 16rem;">
                            <div class="overflow-hidden w-100 position-relative" style="height: 19rem;">
                                <img src="{{ asset('img/thus-spoke-zarathustra.jpg') }}"
                                    class="card-img-top position-absolute top-50 start-50 translate-middle" alt="...">
                            </div>
                            <div class="card-body px-0 lh-1">
                                <div class="row card-title">
                                    <div class="col-8">
                                        <h5 class="card-title fw-bold fs-6 text-truncate">{{ $book->title }}</h5>
                                    </div>
                                    <div class="col-4 text-end">
                                        <p class="card-title fw-bold fs-5">Rp. {{ $book->price }}</p>
                                    </div>
                                </div>
                                <p class="card-text fs-6">by: {{ $book->user->name }}</p>
                                <a href="#" class="btn btn-primary rounded-0 py-2 px-4">Add <i
                                        class="bi bi-basket3"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
