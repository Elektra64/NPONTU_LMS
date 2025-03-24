<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - LMS</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            font-size: 20px;
            color: #ecf0f1;
            margin-bottom: 20px;
        }

        .sidebar a {
            text-decoration: none;
            color: #bdc3c7;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #34495e;
            color: #ffffff;
        }

        .sidebar .active {
            background-color: #1abc9c;
            color: #ffffff;
        }

        /* Top Navigation */
        .top-nav {
            width: 100%;
            background-color: #ffffff;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 250px;
            z-index: 10;
        }

        .top-nav h1 {
            font-size: 20px;
            color: #2c3e50;
            margin: 0;
        }

        .top-nav .logout-btn {
            background-color: #e74c3c;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
        }

        .top-nav .logout-btn:hover {
            background-color: #c0392b;
        }

        /* Main Content */
        .main-content {
            margin-top: 60px;
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            overflow-y: auto;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3c763d;
        }

        .alert-danger {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Admin Dashboard</h2>
    <a href="{{ route('admin.courses.dashboard') }}" class="{{ request()->routeIs('admin.courses.dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('admin.courses.create') }}" class="{{ request()->routeIs('admin.courses.create') ? 'active' : '' }}">Create Course</a>
</div>

<!-- Top Navigation -->
<div class="top-nav">
    <h1>Admin Panel</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

<!-- Main Content -->
<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>
