<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse - Course Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-gray-800 p-4 flex justify-between items-center">
        <div class="text-white text-lg font-bold">EduVerse</div>
        <div class="flex items-center space-x-4">
            <a href="#" class="text-white">Courses</a>
            <a href="#" class="text-white">Dashboard</a>
            <div class="text-white">Welcome, {{ Auth::user()->name ?? 'Guest' }}</div>
            <div class="bg-yellow-500 text-black px-2 py-1 rounded">Learner</div>
        </div>
    </nav>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Course Catalog</h1>
        <div class="flex justify-between items-center mb-4">
            <input type="text" placeholder="Search courses..." class="border p-2 rounded w-1/2">
            <select class="border p-2 rounded">
                <option value="">All Categories</option>
                @isset($categories)
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($courses ?? [] as $course)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $course->title ?? 'Untitled Course' }}</h2>
                    <div class="mt-2 flex items-center">
                        <span class="{{ $course->difficulty_class ?? 'bg-gray-100 text-gray-800' }} text-xs font-semibold px-2.5 py-0.5 rounded">
                            {{ $course->difficulty ?? 'Unknown Level' }}
                        </span>
                        <span class="text-sm text-gray-500 ml-2">{{ $course->category ?? 'Uncategorized' }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">{{ $course->description ?? 'No description available' }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">{{ $course->status ?? 'Status unknown' }}</span>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition duration-200">
                            Learn More
                        </button>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-3 text-center py-10">
                    <p class="text-gray-500">No courses available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>