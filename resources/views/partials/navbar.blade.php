<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/products') }}">
            <img src="{{ asset('images/energeticwave-logo.png') }}" alt="Logotipo" width="200" class="d-inline-block align-text-top">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('navbarmessage.products') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/products">{{ __('navbarmessage.products') }}</a></li>
                        <li><a class="dropdown-item" href="/productsbrands">{{ __('navbarmessage.brands') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/orders">{{ __('navbarmessage.orders') }}</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/wishlist"><i class="fas fa-heart"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cart"><i class="fas fa-shopping-basket"></i></a>
                </li>

                <!-- Language Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLang" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-globe"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownLang">
                        <li><a class="dropdown-item" href="/language/en"><img src="{{ asset('images/flags/us.png') }}" alt="EN" style="width: 20px;"> English</a></li>
                        <li><a class="dropdown-item" href="/language/es"><img src="{{ asset('images/flags/es.png') }}" alt="ES" style="width: 20px;"> Español</a></li>
                    </ul>
                </li>

                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('navbarmessage.login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('navbarmessage.register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/profile">{{ __('navbarmessage.profile') }}</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('navbarmessage.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
<div class="mb-5"></div>
