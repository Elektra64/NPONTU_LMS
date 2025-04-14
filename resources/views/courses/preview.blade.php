<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview: {{ $course['title'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
 <!-- Enhanced Navbar -->
 <x-navbar/>


    <!-- Preview Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Course Header -->
            <div class="relative">
                <img src="{{ $course['image'] }}" alt="{{ $course['title'] }}" class="w-full h-64 object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                    <h1 class="text-3xl font-bold text-white">{{ $course['title'] }}</h1>
                    <p class="text-gray-200">{{ $course['description'] }}</p>
                </div>
                <span class="difficulty-{{ $course['difficulty'] }} text-xs font-bold px-2 py-1 rounded absolute top-2 left-2">
                    {{ ucfirst($course['difficulty']) }}
                </span>
            </div>

            <!-- Course Details -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="md:col-span-2">
                    <h2 class="text-2xl font-bold mb-4">About This Course</h2>
                    <div class="prose max-w-none">
                        <p>This preview gives you an overview of what you'll learn in this course.</p>

                        <h3 class="text-xl font-semibold mt-6 mb-3">What You'll Learn</h3>
                        <ul class="list-disc pl-5 space-y-2">
                            @foreach($content['sections'] as $section)
                                <li>{{ $section['title'] }}</li>
                            @endforeach
                        </ul>

                        <!-- <h3 class="text-xl font-semibold mt-6 mb-3">Course Content</h3> -->
                        <!-- <div class="border rounded-lg overflow-hidden">
                            @foreach($content['sections'] as $index => $section)
                                <div class="border-b last:border-b-0">
                                    <div class="p-4 bg-gray-50 font-medium">
                                        <i class="fas fa-folder-open mr-2 text-yellow-500"></i>
                                        Section {{ $index + 1 }}: {{ $section['title'] }}
                                    </div>
                                    <div class="divide-y">
                                        @foreach($section['lessons'] as $lessonIndex => $lesson)
                                            <div class="p-4 flex items-center">
                                                <i class="fas fa-play-circle mr-3 text-gray-400"></i>
                                                <span>Lesson {{ $lessonIndex + 1 }}: {{ $lesson['title'] }}</span>
                                                <span class="ml-auto text-sm text-gray-500">{{ $lesson['duration'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div> -->
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-bold text-lg mb-3">Course Details</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-chalkboard-teacher mr-2 text-gray-600"></i>
                                <span>Instructor: {{ $course['instructor'] }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users mr-2 text-gray-600"></i>
                                <span>Students: {{ number_format($course['students_count']) }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-star mr-2 text-gray-600"></i>
                                <span>Rating: {{ $course['rating'] }}/5.0</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-tag mr-2 text-gray-600"></i>
                                <span>Category: {{ $course['category'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Enrollment Card -->
                    <div class="border rounded-lg shadow-sm p-4">
                        <div class="text-center mb-4">
                            @if($course['is_free'])
                                <span class="text-3xl font-bold">Free</span>
                            @else
                                <span class="text-3xl font-bold">${{ number_format($course['price'], 2) }}</span>
                                @if($course['standard_price'] > $course['price'])
                                    <span class="line-through text-gray-500 ml-2">${{ number_format($course['standard_price'], 2) }}</span>
                                @endif
                            @endif
                        </div>

                        <a href="/enroll/{{ $course['id'] }}/verify" class="block w-full bg-yellow-500 hover:bg-yellow-600 text-center text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                            Enroll Now
                        </a>

                        @if($course['has_paid_options'])
                            <p class="text-sm text-gray-600 mt-2 text-center">
                                Premium options available after enrollment
                            </p>
                        @endif

                        <div class="mt-4 text-sm">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Full lifetime access</span>
                            </div>
                            <div class="flex items-center mb-2">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Certificate of completion</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

       <!-- Enhanced Footer -->
       <x-footer/>

</body>
</html>
