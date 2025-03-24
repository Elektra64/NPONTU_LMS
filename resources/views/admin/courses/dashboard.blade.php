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
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 240px;
            background-color: #1a202c;
            color: #ffffff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar a {
            color: #cbd5e0;
            text-decoration: none;
            padding: 12px;
            display: block;
            border-radius: 4px;
            transition: background 0.2s ease;
        }

        .sidebar a:hover {
            background-color: #2d3748;
        }

        .sidebar .active {
            background-color: #2d3748;
        }

        .sidebar .bottom-links a {
            color: #718096;
            font-size: 14px;
        }

        /* Main Content Styling */
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f4f4f9;
        }

        /* Top Navigation */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 10px 20px;
            border-bottom: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .user-info {
            font-size: 14px;
            color: #4a5568;
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-size: 18px;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 36px;
            font-weight: bold;
            color: #1a202c;
            margin: 0;
        }

        .create-button {
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: inline-block;
            text-decoration: none;
            text-align: center;
        }

        .create-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div>
        <h2>LMS Admin</h2>
        <a href="{{ route('admin.courses.dashboard') }}" class="active">Dashboard</a>
        <a href="#">Manage Users</a>
        <a href="#">Reports</a>
        <a href="#">Settings</a>
    </div>

    <div class="bottom-links">
        <a href="{{ route('logout') }}">Logout</a>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">

    <!-- Top Nav -->
    <div class="top-nav">
        <div>
            <h1>Admin Dashboard</h1>
        </div>
        <div class="user-info">
            Logged in as <strong>{{ Auth::user()->username }}</strong>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="dashboard-cards">
        <!-- Total Courses -->
        <div class="card">
            <h3>Total Courses</h3>
            <p>{{ $totalCourses ?? 0 }}</p>
        </div>

        <!-- Published Courses -->
        <div class="card">
            <h3>Published Courses</h3>
            <p>{{ $publishedCourses ?? 0 }}</p>
        </div>

        <!-- Draft Courses -->
        <div class="card">
            <h3>Draft Courses</h3>
            <p>{{ $draftCourses ?? 0 }}</p>
        </div>

        <!-- Total Users -->
        <div class="card">
            <h3>Total Users</h3>
            <p>{{ $totalUsers ?? 0 }}</p>
        </div>
    </div>

    <!-- Create New Course Button -->
    <a href="{{ route('admin.courses.create') }}" class="create-button">
        + Create New Course
    </a>
</div>

</body>
</html>
