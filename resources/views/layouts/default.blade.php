<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}" dir="{{ App::currentLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (App::currentLocale() == 'ar')
    <link rel="stylesheet" href="/cssBootstrap/bootstrap.rtl.min.css">
    @else
    <link rel="stylesheet" href="/cssBootstrap/bootstrap.min.css">
    @endif
    <link rel="stylesheet" href="/css/headers.css">
    <title>{{config('app.name')}}</title>
    @stack('styles')
</head>

<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Inventory</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Customers</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Products</a></li>
                </ul>

                <form method="get" action="{{ route('questions.index') }}" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" name="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>

                <div class="dropdown text-end">

                </div>
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="local" data-bs-toggle="dropdown" aria-expanded="false">
                    Language
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="local">
                    <li><a class="dropdown-item" href="{{URL::current() }}?lang=en">English</a></li>
                    <li><a class="dropdown-item" href="{{URL::current() }}?lang=ar">العربية</a></li>
                </ul>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="container py-5">
        <header class="mb-4 bg-light">
            <h2>@yield('title')</h2>
            <hr>
        </header>

        @yield('content')
    </div>
    <script src="/jsBootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>