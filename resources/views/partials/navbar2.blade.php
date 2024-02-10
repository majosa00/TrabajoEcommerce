<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('admin/products') }}">
            <img src="{{ asset('images/energeticwave-logo.png') }}" alt="Logotipo" width="200"
                class="d-inline-block align-text-top">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('admin/products')}}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('admin/brands')}}">Brands</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('admin/orderadmin')}}">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('admin/wishlist')}}">Wishlist</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="/profile">Profile</a>
                                <!-- Enlace de Profile sin destino temporal -->
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>

                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
