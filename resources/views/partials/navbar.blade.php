{{-- <nav class="navbar navbar-expand-lg bg-body">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}
<nav class="navbar sticky-top navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            {{ __('Book.store') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mx-auto left-nav column-gap-4">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item {{ Request::is('books') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('books') }}">Books</a>
                </li>
                <li class="nav-item {{ Request::is('authors') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('authors') }}">Authors</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li> --}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <form class="d-flex border-bottom border-dark me-4" role="search">
                    <i class="bi bi-search align-self-center pe-2"> </i>
                    <input class="form-control search-form rounded-0 me-2 border-0 p-0 bg-transparent" type="search"
                        placeholder="Search book..." aria-label="Search" id="search">
                </form>

                <li class="nav-item d-flex">
                    <a href="#" class="align-self-center text-reset">
                        <i class="bi bi-handbag"></i>
                    </a>
                </li>
                <div class="vr bg-black my-1 mx-2 d-none d-lg-block"></div>
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown text-end ms-auto">
                        <a id="navbarDropdown"
                            class="nav-link overflow-hidden img-thumbnail position-relative rounded-circle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                            style="height:35px; width: 35px;">
                            {{-- {{ Auth::user()->name }} --}}
                            <img src="@if (auth()->user()->avatar) {{ asset('storage/' . auth()->user()->avatar) }} @else{{ asset('img/default-profile.jpg') }} @endif"
                                class="position-absolute h-100 w-auto top-50 start-50 translate-middle" alt="...">
                        </a>

                        <div class="dropdown-menu dropdown-menu-end z-1" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bi bi-person"></i> {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="/profile/{{ auth()->user()->username }}/edit">
                                <i class="bi bi-pencil-square"></i> {{ __('Edit Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-left"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
