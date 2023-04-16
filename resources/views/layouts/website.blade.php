<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('head')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="/images/favicon.png" type="image/png" sizes="16x16">

</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" style="line-height: 1em;" href="/">
                    <div class="row">
                        @if($show_logo == 'Enable')
                        <div class="col-auto">
                            <img src="{{ $logo }}" alt="" style="height:35px;">
                        </div>
                        @endif

                        @if($show_app_name == 'Enable' || $show_tag_line == 'Enable')
                        <div class="col px-0">
                            @if($show_app_name == 'Enable')
                            <h5 class="p-0 m-0" style="line-height: 1em;">{{ $app_name }}</h5>
                            @endif
                            @if($show_tag_line == 'Enable')
                            <span style="font-size:10px;line-height: 1em;">{{ $tag_line }}</span>
                            @endif
                        </div>
                        @endif
                    </div>
                </a>
                <button style="border: none;outline:none; box-shadow:none;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">

                        @foreach($cats as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('category/'.$category->id.'*')) ? 'active' : '' }}" href="/category/{{$category->id}}">{{$category->category}}</a>
                        </li>
                        @endforeach

                        @guest
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}"><i class="fas fa-user fa-fw"></i></a>
                        </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            <div class="btn-group-vertical position-fixed right-0 top-50" role="group" aria-label="Vertical button group" style="z-index:1000; transform:translate(0%, -50%)">
                <a class="btn btn-lg btn-primary rounded-0 border-bottom" style="border-radius: 10px 0 0 0 !important;" href="/search"><i class="fas fa-search"></i></a>
                <a class="btn btn-lg btn-primary position-relative border-bottom" href="/cart">

                    <span class="badge text-bg-danger position-absolute top-50 translate-middle {{(session()->has('cart') && sizeof(session('cart')) > 0) ? '' : 'd-none'}}" style="left: -5px;" id="myCart">{{ sizeof(session("cart")) }}</span>

                    <i class="fas fa-shopping-cart"></i></a>
                <a class="btn btn-lg btn-primary border-bottom" href="/wishlist"><i class="fas fa-heart"></i></a>
                @guest
                <a class="btn btn-lg btn-primary rounded-0" style="border-radius: 0 0 0 10px !important;" href="{{ route('login') }}"><i class="fas fa-user fa-fw"></i></a>
                @endguest
                @auth
                <a href="/customer" class="btn btn-lg btn-primary border-bottom"><i class="fas fa-user fa-fw"></i></a>
                <a class="btn btn-lg btn-primary rounded-0" style="border-radius: 0 0 0 10px !important;" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-fw"></i>
                </a>
                @endauth
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @yield('content')
        </main>

        <div class="container-fluid text-bg-light py-3">
            <div class="container text-center">

                <a class="btn btn-dark rounded-circle btn-lg" style="height:60px; width:60px; font-size: 22px; line-height:22px; padding:18px 0;" target="_blank" href="{{$facebook}}"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark rounded-circle btn-lg" style="height:60px; width:60px; font-size: 22px; line-height:22px; padding:18px 0;" target="_blank" href="{{$instagram}}"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-dark rounded-circle btn-lg" style="height:60px; width:60px; font-size: 22px; line-height:22px; padding:18px 0;" target="_blank" href="{{$youtube}}"><i class="fab fa-youtube"></i></a>
                <a class="btn btn-dark rounded-circle btn-lg" style="height:60px; width:60px; font-size: 22px; line-height:22px; padding:18px 0;" target="_blank" href="https://wa.me/{{$whatsapp}}"><i class="fab fa-whatsapp"></i></a>

            </div>
        </div>

        <div class="container-fluid text-bg-secondary py-2">
            <div class="container text-center">

                <a class="btn btn-secondary" href="/about">About</a>
                <a class="btn btn-secondary" href="/contact">Contact</a>
                <a class="btn btn-secondary" href="/tnc">Terms</a>
                <a class="btn btn-secondary" href="/rnr">Return</a>
                <a class="btn btn-secondary" href="/privacy">Privacy</a>

            </div>
        </div>

        <div class="container-fluid text-bg-dark py-3">
            <div class="container text-center">
                <span>Copyright &copy; {{ date('Y') }} <a class="btn btn-dark text-uppercase" href="/">{{ $app_name }}</a> All Rights Reserved.</span>
            </div>
        </div>

    </div>

    @include('sweetalert::alert')

</body>
</html>
