@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col col-md-6 text-center">
            {{-- error notif --}}
            @error('cover' || 'title' || 'price')
                <div class="alert alert-danger alert-dismissible d-inline-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>
                        {{ $message }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            {{-- Success notif --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible d-inline-flex align-items-center" role="alert">
                    <i class="bi check-circle-fill"></i>
                    <div>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    {{-- Modal Create --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-1">
                <div class="modal-body">
                    <div class="d-flex mb-5">
                        <h1 class="modal-title fs-5 montserrat mx-auto fw-bolder" id="createModalLabel">Add Your Book</h1>
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    {{-- Form --}}
                    <form action="/profile" method="POST" class="px-3">
                        @csrf
                        <div class="row">
                            <label for="inputImage" class="col-sm-2 col-form-label montserrat fw-semibold">Cover</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control montserrat" id="inputGroupFile02"
                                        placeholder="Book cover" name="cover" value="{{ old('cover') }}">
                                    <label class="input-group-text montserrat" for="inputGroupFile02">Upload</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputBookName" class="col-sm-2 col-form-label montserrat fw-semibold">Name</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control montserrat" id="inputBookName"
                                    placeholder="Book name" name="title" required value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputPrice" class="col-sm-2 col-form-label montserrat fw-semibold">Price</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <span class="input-group-text montserrat">Rp</span>
                                    <input type="number" min="0" class="form-control montserrat"
                                        oninput="validity.valid||(value='');" placeholder="10.000"
                                        aria-label="Amount (to the nearest rupiah)" name="price" required
                                        value="{{ old('price') }}">
                                    <span class="input-group-text montserrat">,00</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="btn btn-secondary mx-2 montserrat fw-semibold"
                                data-bs-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-primary ms-2 montserrat fw-semibold"
                                id="liveToastBtn">Save
                                changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-1">
                <div class="modal-body">
                    <div class="d-flex mb-5">
                        <h1 class="modal-title fs-5 montserrat mx-auto fw-bolder" id="editModalLabel">Add Your Book</h1>
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    {{-- Form --}}
                    <form action="/profile" method="POST" class="px-3">
                        @csrf
                        <div class="row">
                            <label for="editImage" class="col-sm-2 col-form-label montserrat fw-semibold">Cover</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control montserrat" id="editGroupFile02"
                                        placeholder="Book cover" name="cover" value="{{ old('cover') }}">
                                    <label class="input-group-text montserrat" for="editGroupFile02">Upload</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="editBookName" class="col-sm-2 col-form-label montserrat fw-semibold">Name</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control montserrat" id="editBookName"
                                    placeholder="Book name" name="title" required value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="row">
                            <label for="editPrice" class="col-sm-2 col-form-label montserrat fw-semibold">Price</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <span class="input-group-text montserrat">Rp</span>
                                    <input id="editPrice" type="number" min="0" class="form-control montserrat"
                                        oninput="validity.valid||(value='');" placeholder="10.000"
                                        aria-label="Amount (to the nearest rupiah)" name="price" required
                                        value="{{ old('price') }}">
                                    <span class="input-group-text montserrat">,00</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="btn btn-secondary mx-2 montserrat fw-semibold"
                                data-bs-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-primary ms-2 montserrat fw-semibold"
                                id="liveToastBtn">Save
                                changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--  --}}

    <div class="vh-50 text-center d-flex">
        <div class="m-auto" style="height: 575px; width: 575px;">
            <div class="overflow-hidden mx-auto my-3 rounded-circle position-relative shadow img-thumbnail"
                style="height: 19rem; width: 19rem;">
                <img src="{{ asset('img/monka.jpeg') }}"
                    class="position-absolute h-100 w-auto top-50 start-50 translate-middle" alt="...">
            </div>
            <h1 class="my-3">{{ $author }}</h1>
            <p class="text-uppercase text-secondary montserrat" style="letter-spacing: 1em">center java, indonesia</p>
            <div class="row justify-content-center mt-5">
                <div class="col">
                    <h4 class="text-secondary small montserrat">Your Books</h4>
                    <p class="fs-1 montserrat">{{ $myBooks->count() }}</p>
                </div>
                <div class="col">
                    <h4 class="text-secondary small montserrat">Purchased Books</h4>
                    <p class="fs-1 montserrat">{{ $purchasedBooks->count() }}</p>

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
                            <button type="button" class="btn btn-outline-dark" id="editBtn"
                                onclick="Edit('editBtn');">Edit</button>

                        </div>
                    </div>
                </div>

                @foreach ($myBooks as $myBook)
                    <div class="col-auto mb-3 shake-constant">
                        <div class="card border-0 bg-transparent" style="width: 16rem;">
                            <div class="overflow-hidden w-100 position-relative" style="height: 19rem;">
                                <img src="{{ asset('img/thus-spoke-zarathustra.jpg') }}"
                                    class="card-img-top position-absolute top-50 start-50 translate-middle"
                                    alt="...">
                                <div class="position-absolute top-50 start-50 translate-middle edit-option d-none">
                                    <div class="row">
                                        <div class="vstack gap-2 col-5 mx-auto">
                                            <button type="button" class="btn btn-secondary">Edit the Book</button>
                                            <form action="/profile/{{ $myBook->slug }}" method="post"
                                                class="d-flex justify-content-center">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger border-0"
                                                    onclick="return confirm('Are you sure?');">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                        data-bs-target="#createModal" style="width: 16rem; height: 19rem;">
                        <div class="m-auto"><i class="bi bi-plus-square fs-1"></i>
                            <p class="montserrat fw-bold">Add New Book</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="min-vh-100 container d-flex">
        <div class="my-auto">
            <div class="row justify-content-between mt-2">
                <div class="col-12 d-flex mb-3 align-items-end">
                    <h2 class="fw-bolder flex-fill">Purchased Books</h2>
                </div>

                @foreach ($purchasedBooks as $book)
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
