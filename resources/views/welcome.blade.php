@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="display-4">Learn from the Best</h1>
    <p class="lead">Explore thousands of courses from top universities and industry leaders.</p>
    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
</div>
@endsection
