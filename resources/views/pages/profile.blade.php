@extends('layouts.app')

@section('content')
    @if (Route::currentRouteName() == 'editProfile')
        <form action="/profile/{{ $author->username }}/edit" method="POST" class="px-3" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="vh-75 text-center">
                <div class="m-auto" style="height: 575px; width: 575px;">
                    <label class="overflow-hidden mx-auto my-3 rounded-circle position-relative shadow img-thumbnail"
                        for="inputImage" style="height: 19rem; width: 19rem;">
                        <img class="position-absolute img-preview h-100 w-auto top-50 start-50 translate-middle"
                            alt="..."
                            src="@if ($author->avatar) {{ asset('storage/' . $author->avatar) }} @else{{ asset('img/default-profile.jpg') }} @endif">
                        <a
                            class="montserrat btn btn-primary opacity-25 position-absolute top-50 start-50 translate-middle">Edit</a>
                    </label>
                    <input type="file" class="form-control montserrat d-none" id="inputImage" placeholder="Your Avatar"
                        name="avatar" value="{{ old('image') }}" onchange="previewImg('editProfile');">
                    <div class="row">
                        <label for="changeName" class="col-sm-3 col-form-label montserrat fw-semibold">Change Name</label>
                        <div class="col-sm-6 align-self-center">
                            <input type="text" class="form-control montserrat" id="changeName"
                                placeholder="{{ $author->name }}" name="name" required value="{{ old('name') }}">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary ms-2 montserrat fw-semibold" id="liveToastBtn">Save
                        changes
                    </button>
                </div>
            </div>
        </form>
    @else
        <div class="row justify-content-center">
            <div class="col col-md-6 text-center">
                {{-- error notif --}}
                @error('image' || 'title' || 'price')
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
                    <div class="fixed-bottom mt-5">
                        <div class="alert alert-success alert-dismissible d-inline-flex align-items-center" role="alert">
                            <i class="bi check-circle-fill"></i>
                            <div>
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
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
                            <h1 class="modal-title fs-5 montserrat mx-auto fw-bolder" id="createModalLabel">Add Your Book
                            </h1>
                            <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        {{-- Form --}}
                        <form action="/profile" method="POST" class="px-3" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <label for="inputImage"
                                    class="col-sm-2 col-form-label montserrat fw-semibold align-self-center">Image</label>
                                <div class="col-sm-10">
                                    <img class="img-preview img-fluid mb-3 col-sm-5">
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control montserrat" id="inputImage"
                                            placeholder="Book image" name="image" value="{{ old('image') }}"
                                            onchange="previewImg();">
                                        <label class="input-group-text montserrat" for="inputImage">Upload</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputBookName"
                                    class="col-sm-2 col-form-label montserrat fw-semibold">Name</label>
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

        {{--  --}}
        {{-- Profile --}}
        <div class="vh-75 text-center d-flex">
            <div class="m-auto" style="height: 575px; width: 575px;">
                <div class="overflow-hidden mx-auto my-3 rounded-circle position-relative shadow img-thumbnail"
                    style="height: 19rem; width: 19rem;">
                    <img src="@if ($author->avatar) {{ asset('storage/' . $author->avatar) }} @else{{ asset('img/default-profile.jpg') }} @endif"
                        class="position-absolute h-100 w-auto top-50 start-50 translate-middle" alt="...">
                </div>
                <h1 class="my-3">{{ $author->name }}</h1>
                <p class="text-uppercase text-secondary montserrat" style="letter-spacing: 1em">center java, indonesia</p>
                @if ($isMyProfile)
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
                @endif
            </div>
        </div>

        <div class="container" style="min-height: 50vh;">
            <div class="my-auto">
                <div class="row justify-content-center mt-2">
                    <div class="col-12 mb-3 align-items-end">
                        <div class="row">
                            @if ($isMyProfile)
                                <div class="col-auto">
                                    <h2 class="fw-bolder">Your Books</h2>
                                </div>
                                <div class="col-auto ms-auto align-self-center">
                                    <button type="button" class="btn btn-outline-dark" id="editBtn"
                                        onclick="edit('editBtn');">Edit</button>

                                </div>
                            @else
                                <div class="col-12 text-center">
                                    <h2 class="fw-bolder">My Books</h2>
                                </div>
                            @endif
                        </div>
                    </div>

                    @foreach ($myBooks as $myBook)
                        <div class="col-auto mb-3 shake-constant">
                            <div class="card border-0 bg-transparent" style="width: 16rem;">
                                <div class="overflow-hidden w-100 position-relative" style="height: 19rem;">
                                    <img src="@if ($myBook->image) {{ asset('storage/' . $myBook->image) }} @else {{ asset('img/default-book.png') }} @endif"
                                        class="card-img-top position-absolute top-50 start-50 translate-middle"
                                        alt="...">
                                    <div class="position-absolute top-50 start-50 translate-middle edit-option d-none">
                                        <div class="row">
                                            <div class="vstack gap-2 col-5 mx-auto">
                                                <button class="btn btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $loop->index }}">Edit
                                                    Book</button>
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
                                            <h5 class="card-title fw-bold fs-6 text-truncate">{{ $myBook->title }}
                                            </h5>
                                        </div>
                                        <div class="col-auto text-end">
                                            <p class="card-title fw-bold fs-5">Rp.
                                                {{ number_format($myBook->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <p class="card-text fs-6">by: {{ $myBook->user->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto p-0">
                            {{-- Modal Edit --}}
                            <div class="modal fade" id="editModal{{ $loop->index }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $loop->index }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-1">
                                        <div class="modal-body">
                                            <div class="d-flex mb-5">
                                                <h1 class="modal-title fs-5 montserrat mx-auto fw-bolder"
                                                    id="editModalLabel{{ $loop->index }}">Edit Your Book</h1>
                                                <button type="button" class="btn-close float-end"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            {{-- Form --}}
                                            <form action="/profile/{{ $myBook->slug }}" method="POST" class="px-3"
                                                enctype="multipart/form-data">
                                                @method('put')
                                                @csrf
                                                <div class="row">
                                                    <label for="editImage"
                                                        class="col-sm-2 col-form-label montserrat fw-semibold align-self-center">Image</label>
                                                    <div class="col-sm-10">
                                                        <img class="img-preview img-fluid col-sm-5"
                                                            @if ($myBook->image) src="{{ asset('storage/' . $myBook->image) }}" @endif>
                                                        <div
                                                            class="input-group
                                                        my-3">
                                                            <input type="file" class="form-control montserrat"
                                                                id="editImage" placeholder="Book image" name="image"
                                                                value="{{ old('image') }}" onchange="previewImg();">
                                                            <label class="input-group-text montserrat"
                                                                for="editImage">Upload</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="editBookName"
                                                        class="col-sm-2 col-form-label montserrat fw-semibold">Name</label>
                                                    <div class="col-sm-10 mb-3">
                                                        <input type="text" class="form-control montserrat"
                                                            id="editBookName" placeholder="Book name" name="title"
                                                            required value="{{ old('title', $myBook->title) }}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="editPrice"
                                                        class="col-sm-2 col-form-label montserrat fw-semibold">Price</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text montserrat">Rp</span>
                                                            <input id="editPrice" type="number" min="0"
                                                                class="form-control montserrat"
                                                                oninput="validity.valid||(value='');" placeholder="10.000"
                                                                aria-label="Amount (to the nearest rupiah)" name="price"
                                                                required value="{{ old('price', $myBook->price) }}">
                                                            <span class="input-group-text montserrat">,00</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-end mt-2">
                                                    <button type="button"
                                                        class="btn btn-secondary mx-2 montserrat fw-semibold"
                                                        data-bs-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit"
                                                        class="btn btn-primary ms-2 montserrat fw-semibold"
                                                        id="liveToastBtn">Save
                                                        changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ($isMyProfile)
                        <div class="col-auto mb-3">
                            <button class="d-flex btn btn-outline-dark border-2" data-bs-toggle="modal"
                                data-bs-target="#createModal" style="width: 16rem; height: 19rem;">
                                <div class="m-auto"><i class="bi bi-plus-square fs-1"></i>
                                    <p class="montserrat fw-bold">Add New Book</p>
                                </div>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if ($isMyProfile)
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
                                        <img src="@if ($book->image) {{ asset('storage/' . $book->image) }} @else {{ asset('img/default-book.png') }} @endif"
                                            class="card-img-top position-absolute top-50 start-50 translate-middle"
                                            alt="...">
                                    </div>
                                    <div class="card-body px-0 lh-1">
                                        <div class="row card-title justify-content-between">
                                            <div class="col-6">
                                                <h5 class="card-title fw-bold fs-6 text-truncate">
                                                    {{ $book->title }}</h5>
                                            </div>
                                            <div class="col-auto text-end">
                                                <p class="card-title fw-bold fs-5">
                                                    Rp. {{ number_format($book->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <p>by:
                                            <a href="/profile/{{ $book->user->username }}"
                                                class="card-text fs-6 text-decoration-none text-black">
                                                {{ $book->user->name }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection
