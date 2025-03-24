@extends('layouts.app')

@section('content')
<div class="auth-wrapper d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="auth-card card shadow p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Create a New Account</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- First Name -->
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required />
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required />
            </div>

            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required />
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" required />
            </div>

            <!-- Role -->
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="learner">Learner</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100 mt-3">Sign Up</button>

            <p class="mt-3 text-center">
                Already have an account? <a href="{{ route('login') }}">Sign In</a>
            </p>
        </form>
    </div>
</div>
@endsection
