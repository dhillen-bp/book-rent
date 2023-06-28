<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Rental Buku | @yield('title')</title>
</head>

<body>

    <div class="main d-flex flex-column justify-content-between">
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Rental Buku</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar"
                    aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <div class="body-content h-100">
            <div class="row g-0 h-100">
                <div class="sidebar col-lg-2 collapse d-lg-block bg-dark" id="sidebar">
                    <ul class="text-white navbar-nav p-3 pb-3">
                        @if (Auth::User())

                            @if (Auth::User()->role_id === 1)
                                <li class="nav-item mb-3">
                                    <a href="/dashboard"
                                        class="nav-link @if (request()->route()->uri == 'dashboard') active @endif"><i
                                            class="bi bi-house-door-fill"></i> Dashboard</a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a href="/books"
                                        class="nav-link @if (in_array(request()->route()->uri, ['books', 'book-add', 'book-deleted', 'book-edit/{slug}', 'book-delete/{slug}'])) active @endif"><i
                                            class="bi bi-book-fill"></i> Books</a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a href="/categories"
                                        class="nav-link @if (request()->route()->uri == 'categories' ||
                                                request()->route()->uri == 'category-add' ||
                                                request()->route()->uri == 'category-deleted' ||
                                                request()->route()->uri == 'category-edit/{slug}' ||
                                                request()->route()->uri == 'category-delete/{slug}') active @endif"><i
                                            class="bi bi-tags-fill"></i> Categories</a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a href="/users"
                                        class="nav-link @if (in_array(request()->route()->uri, [
                                                'users',
                                                'registered-users',
                                                'user-approve/{slug}',
                                                'user-ban/{slug}',
                                                'user-deleted',
                                            ])) active @endif"><i
                                            class="bi bi-people-fill"></i> Users</a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a href="/rent-logs"
                                        class="nav-link @if (request()->route()->uri == 'rent-logs') active @endif"><i
                                            class="bi bi-journal-bookmark-fill"></i> Rent Log</a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a href="/book-rent"
                                        class="nav-link @if (request()->route()->uri == 'book-rent') active @endif"><i
                                            class="bi bi-journal-check"></i> Book Rent</a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a href="/book-return"
                                        class="nav-link @if (request()->route()->uri == 'book-return') active @endif"><i
                                            class="bi bi-journal-x"></i> Book Return</a>
                                </li>
                            @else
                                <li class="nav-item mb-3">
                                    <a href="/profile"
                                        class="nav-link @if (request()->route()->uri == 'profile') active @endif"><i
                                            class="bi bi-person-fill"></i> Profile</a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a href="/"
                                        class="nav-link @if (request()->route()->uri == '/') active @endif"><i
                                            class="bi bi-journals"></i> Book List</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="/logout" class="nav-link my-auto"><i class="bi bi-door-closed-fill"></i>
                                    Logout</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="/login" class="nav-link"><i class="bi bi-door-open-fill"></i> Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="content p-5 col-lg-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
