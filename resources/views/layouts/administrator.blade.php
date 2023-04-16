<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('head')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">

<div id="menu" class="menu bg-light">
    <div class="menu-container">
        <div class="container p-0 bg-dark text-light">
            <p class="text-uppercase mb-0 p-3">ADMINISTRATOR</p>
        </div>

        <ul class="list-group mb-5 rounded-0 accordion p-1" id="accordionExample">
                

            <div class="accordion" id="accordionExample">

            
                <div class="accordion-item bg-primary">
                    <h2 class="accordion-header" id="headingOne">
                        <a href="/administrator" class="btn accordion-button collapsed no-caret {{ (request()->is('administrator')) ? 'bg-primary text-light' : 'bg-light text-dark' }}" data-bs-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                            <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                            Dashboard
                        </a>
                    </h2>
                </div>

                <div class="accordion-item bg-primary">
                    <h2 class="accordion-header" id="headingOne">
                        <a href="/administrator/purchase" class="btn accordion-button collapsed no-caret {{ (request()->is('administrator/purchase')) ? 'bg-primary text-light' : 'bg-light text-dark' }}" data-bs-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                            <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                            Purchase
                        </a>
                    </h2>
                </div>

                <div class="accordion-item bg-primary">
                    <h2 class="accordion-header" id="headingOne">
                        <a href="/administrator/offers" class="btn accordion-button collapsed no-caret {{ (request()->is('administrator/offers')) ? 'bg-primary text-light' : 'bg-light text-dark' }}" data-bs-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                            <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                            Offers
                        </a>
                    </h2>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingWebsiteManager">
                        <button class="accordion-button {{ (request()->is('administrator/website_manager*')) ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWebsiteManager" aria-expanded="true" aria-controls="collapseWebsiteManager">
                            <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                            Website Manager
                        </button>
                    </h2>
                    <div id="collapseWebsiteManager" class="accordion-collapse collapse {{ (request()->is('administrator/website_manager*')) ? 'show' : '' }}" aria-labelledby="headingWebsiteManager" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush bg-light d-grid p-0">
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/website_manager/slider')) ? 'fw-bold' : '' }}" href="/administrator/website_manager/slider">Slider Manager</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/website_manager/features')) ? 'fw-bold' : '' }}" href="/administrator/website_manager/features">Features Manager</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/website_manager/pages')) ? 'fw-bold' : '' }}" href="/administrator/website_manager/pages">Pages Manager</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/website_manager/content')) ? 'fw-bold' : '' }}" href="/administrator/website_manager/content">Content Manager</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingProductsManager">
                        <button class="accordion-button {{ (request()->is('administrator/products*')) ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProductsManager" aria-expanded="true" aria-controls="collapseProductsManager">
                            <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                            Products Manager
                        </button>
                    </h2>
                    <div id="collapseProductsManager" class="accordion-collapse collapse {{ (request()->is('administrator/products*')) ? 'show' : '' }}" aria-labelledby="headingProductsManager" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush bg-light d-grid p-0">
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/products/category')) ? 'fw-bold' : '' }}" href="/administrator/products/category">Category</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/products/sub_category')) ? 'fw-bold' : '' }}" href="/administrator/products/sub_category">Sub Category</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/products/product_group')) ? 'fw-bold' : '' }}" href="/administrator/products/product_group">Product Group</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOrderssManager">
                        <button class="accordion-button {{ (request()->is('administrator/orders*')) ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrderssManager" aria-expanded="true" aria-controls="collapseOrderssManager">
                            <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                            Order Manager
                        </button>
                    </h2>
                    <div id="collapseOrderssManager" class="accordion-collapse collapse {{ (request()->is('administrator/orders*')) ? 'show' : '' }}" aria-labelledby="headingOrderssManager" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush bg-light d-grid p-0">
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/orders/pending')) ? 'fw-bold' : '' }}" href="/administrator/orders/pending">Pending</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/orders/accepted')) ? 'fw-bold' : '' }}" href="/administrator/orders/accepted">Accepted</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/orders/packed')) ? 'fw-bold' : '' }}" href="/administrator/orders/packed">Packed</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/orders/shipped')) ? 'fw-bold' : '' }}" href="/administrator/orders/shipped">Shipped</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/orders/delivered')) ? 'fw-bold' : '' }}" href="/administrator/orders/delivered">Delivered</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingReports">
                        <button class="accordion-button {{ (request()->is('administrator/reports*')) ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReports" aria-expanded="true" aria-controls="collapseReports">
                            <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                            Reports
                        </button>
                    </h2>
                    <div id="collapseReports" class="accordion-collapse collapse {{ (request()->is('administrator/reports*')) ? 'show' : '' }}" aria-labelledby="headingReports" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush bg-light d-grid p-0">
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0 {{ (request()->is('administrator/reports/purchase')) ? 'fw-bold' : '' }}" href="/administrator/reports/purchase">Purchase</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item bg-primary">
                    <h2 class="accordion-header" id="headingOne">
                        <a href="/administrator/settings" class="btn accordion-button collapsed no-caret {{ (request()->is('administrator/settings')) ? 'bg-primary text-light' : 'bg-light text-dark' }}" data-bs-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                            <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                            Settings
                        </a>
                    </h2>
                </div>

                <!-- <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush bg-light d-grid p-0">
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0" href="/course/3">Construction</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0" href="/course/1">English</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0" href="/course/2">Marathi</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0" href="/course/53">Information</a></li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                
                <!-- <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush bg-light d-grid p-0">
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0" href="/course/3">Construction</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0" href="/course/1">English</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0" href="/course/2">Marathi</a></li>
                                <li class="list-group-item" style="background: transparent !important;"><a class="btn btn-sm btn-default btn-full border-0" href="/course/53">Information</a></li>
                            </ul>
                        </div>
                    </div>
                </div> -->

            </div>

        </ul>


    </div>
</div>

<div id="panel" class="panel">
    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-uppercase" id="handel" href="javascript:void(0);"><i class="fas fa-bars fa-lg fa-fw"></i> {{Auth::user()->name}}</a>
            <ul class="navbar-nav">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/">Website</a>
                </li> -->
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    @yield('content')

</div>



</div>

@include('sweetalert::alert')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')

</body>
</html>
