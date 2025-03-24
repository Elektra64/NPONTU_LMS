<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Course Platform') }}</title>

    <!-- ✅ Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- ✅ Add Bootstrap (Optional) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- ✅ Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            CoursePlatform
        </a>

        <!-- ✅ Search Bar -->
        <form class="form-inline my-2 my-lg-0 ml-auto">
            <input class="form-control mr-sm-2" type="search" placeholder="Search courses..." aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <!-- ✅ Authentication Buttons -->
        <div class="ml-3">
            @auth
                <a href="{{ route('admin.courses.dashboard') }}" class="btn btn-outline-primary">{{ Auth::user()->name }}</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
            @endauth
        </div>
    </div>
</nav>

<!-- ✅ Categories Dropdown -->
<div class="container mt-3">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categories
        </button>
        <div class="dropdown-menu" aria-labelledby="categoryDropdown">
            <a class="dropdown-item" href="#">Business</a>
            <a class="dropdown-item" href="#">Technology</a>
            <a class="dropdown-item" href="#">Health & Wellness</a>
            <a class="dropdown-item" href="#">Language</a>
        </div>
    </div>
</div>

<!-- ✅ Main Content -->
<main class="py-4">
    @yield('content')
</main>

<!-- ✅ Footer -->
<footer class="bg-dark text-white text-center py-3 mt-5">
    <div class="container">
        <p>&copy; {{ date('Y') }} Course Platform. All rights reserved.</p>
    </div>
</footer>

<!-- ✅ Add Bootstrap JS (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
