@extends('layouts.app')

@section('content')
    <div class="vh-50 text-center d-flex">
        <div class="m-auto" style="height: 575px; width: 575px;">
            <div class="overflow-hidden mx-auto my-3 rounded-circle position-relative shadow img-thumbnail"
                style="height: 19rem; width: 19rem;">
                <img src="{{ asset('img/monka.jpeg') }}"
                    class="position-absolute h-100 w-auto top-50 start-50 translate-middle" alt="...">
            </div>
            <h1 class="my-3">{{ Auth::user()->name }}</h1>
            <p class="text-uppercase text-secondary montserrat" style="letter-spacing: 1em">center java, indonesia</p>
            <div class="row justify-content-center mt-5">
                <div class="col">
                    <h4 class="text-secondary small montserrat">Your Books</h4>
                    <p class="fs-1 montserrat">0</p>
                </div>
                <div class="col">
                    <h4 class="text-secondary small montserrat">Purchased Books</h4>
                    <p class="fs-1 montserrat">0</p>

                </div>
            </div>
        </div>
    </div>
    <div class="min-vh-100 container">
        <div class="my-auto">
            <div class="row justify-content-center mt-2">
                <div class="col-12 mb-3 align-items-end">
                    <div class="row">
                        <div class="col-auto">
                            <h2 class="fw-bolder">Your Books</h2>
                        </div>
                        <div class="col-auto ms-auto align-self-center">
                            <span class="small align-text-bottom">Edit</span>
                        </div>
                    </div>
                </div>

                @foreach ($myBooks as $myBook)
                    <div class="col-auto mb-3 shake-constant">
                        <div class="card border-0 bg-transparent" style="width: 16rem;">
                            <div class="overflow-hidden w-100 position-relative" style="height: 19rem;">
                                <img src="{{ asset('img/thus-spoke-zarathustra.jpg') }}"
                                    class="card-img-top position-absolute top-50 start-50 translate-middle" alt="...">
                            </div>
                            <div class="card-body px-0 lh-1">
                                <div class="row card-title justify-content-between">
                                    <div class="col-6">
                                        <h5 class="card-title fw-bold fs-6 text-truncate">{{ $myBook->title }}</h5>
                                    </div>
                                    <div class="col-auto text-end">
                                        <p class="card-title fw-bold fs-5">Rp. {{ $myBook->price }}</p>
                                    </div>
                                </div>
                                <p class="card-text fs-6">by: {{ $myBook->user->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-auto mb-3">
                    <button class="d-flex btn btn-outline-dark border-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" style="width: 16rem; height: 19rem;">
                        <div class="m-auto"><i class="bi bi-plus-square fs-1"></i>
                            <p class="montserrat fw-bold">Add New Book</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-1">
                {{-- <div class="modal-header">
                </div> --}}
                <div class="modal-body">
                    <div class="d-flex mb-5">
                        <h1 class="modal-title fs-5 montserrat mx-auto fw-bolder" id="exampleModalLabel">Add Your Book</h1>
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="" method="post" class="px-3">
                        <div class="row">
                            <label for="inputImage" class="col-sm-2 col-form-label montserrat fw-semibold">Cover</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control montserrat" id="inputGroupFile02"
                                        placeholder="Book cover">
                                    <label class="input-group-text montserrat" for="inputGroupFile02">Upload</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputBookName" class="col-sm-2 col-form-label montserrat fw-semibold">Name</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control montserrat" id="inputBookName"
                                    placeholder="Book name">
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputPrice" class="col-sm-2 col-form-label montserrat fw-semibold">Price</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <span class="input-group-text montserrat">Rp</span>
                                    <input type="text" class="form-control montserrat" placeholder="10.000"
                                        aria-label="Amount (to the nearest rupiah)">
                                    <span class="input-group-text montserrat">,00</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="btn btn-secondary mx-2 montserrat fw-semibold"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-2 montserrat fw-semibold">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="min-vh-100 container d-flex">
        <div class="my-auto">
            <div class="row justify-content-between mt-2">
                <div class="col-12 d-flex mb-3 align-items-end">
                    <h2 class="fw-bolder flex-fill">Purchased Books</h2>
                    <span class="small align-text-bottom">Edit</span>
                </div>

                @foreach ($books->except('user_id', auth()->user()->id) as $book)
                    <div class="col-auto mb-3">
                        <div class="card border-0 bg-transparent" style="width: 16rem;">
                            <div class="overflow-hidden w-100 position-relative" style="height: 19rem;">
                                <img src="{{ asset('img/thus-spoke-zarathustra.jpg') }}"
                                    class="card-img-top position-absolute top-50 start-50 translate-middle"
                                    alt="...">
                            </div>
                            <div class="card-body px-0 lh-1">
                                <div class="row card-title">
                                    <div class="col-8">
                                        <h5 class="card-title fw-bold fs-6 text-truncate">{{ $book->title }}</h5>
                                    </div>
                                    <div class="col-4 text-end">
                                        <p class="card-title fw-bold fs-5">{{ $book->price }}</p>
                                    </div>
                                </div>
                                <p class="card-text fs-6">by: {{ $book->user->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
