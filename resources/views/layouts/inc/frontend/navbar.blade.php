<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-2 my-auto d-none d-md-block">
                    <a href="{{ route('frontend.index') }}">
                        <h5 class="brand-name">Task</h5>
                    </a>
                </div>
                <div class="col-md-10 my-auto">
                    <ul class="nav justify-content-end">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.category') }}">
                                <i class="fa fa-shopping-cart"></i> Category
                            </a>
                        </li>

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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.index') }}">
                                    <i class="fa fa-shopping-cart"></i> Cart ({{ $cartCount }})
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-capitalize" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
