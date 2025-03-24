@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Create a New Course</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.courses.store') }}" method="POST">
            @csrf

            <!-- Title -->
            <div class="form-group">
                <label for="title">Course Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Course Description</label>
                <textarea id="description" name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Course Intro -->
            <div class="form-group">
                <label for="intro_content">Course Intro</label>
                <input type="text" id="intro_content" name="intro_content" class="form-control" value="{{ old('intro_content') }}" required>
                @error('intro_content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Difficulty Level -->
            <div class="form-group">
                <label for="difficulty_level">Difficulty Level</label>
                <select id="difficulty_level" name="difficulty_level" class="form-control" required>
                    <option value="">Select Difficulty</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
                @error('difficulty_level')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Course Length -->
            <div class="form-group">
                <label for="time_limit">Course Length (in hours)</label>
                <input type="number" id="time_limit" name="time_limit" class="form-control" value="{{ old('time_limit') }}">
                @error('time_limit')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="">Select Status</option>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Course</button>
            </div>
        </form>
    </div>
</div>
@endsection
