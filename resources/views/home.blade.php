<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse University</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-gray-900 text-white p-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <span class="text-xl font-bold">EduVerse</span>
            <a href="{{ route('publishedCourse') }}" class="hover:underline">Courses</a>
            <a href="#" class="hover:underline">Dashboard</a>
        </div>
        <div class="flex items-center space-x-4">
            <span>Welcome, user1</span>
            <span class="bg-yellow-500 text-black px-2 py-1 rounded">Learner</span>
            <div class="w-8 h-8 bg-white rounded-full"></div>
        </div>
    </nav>
    <header class="relative text-white text-center py-20">
        <img alt="Background image of EduVerse University" class="absolute inset-0 w-full h-full object-cover z-0" height="600" src="https://storage.googleapis.com/a1aa/image/NsEX4p-a4_ggpQASfKHWUdQer5yx5ciB-B_uXQpaoWA.jpg" width="1920"/>
        <div class="relative z-10 bg-gray-900 bg-opacity-75 py-20">
            <h1 class="text-4xl font-bold">Welcome to EduVerse University</h1>
            <p class="mt-4 text-lg">Transform your future with our cutting-edge online education platform. Learn from industry experts and earn recognized certifications.</p>
            <button class="mt-6 bg-yellow-500 text-black px-6 py-2 rounded hover:bg-yellow-600 hover:text-white transition duration-300">
            <a href="{{ route('publishedCourse') }}">Explore Courses</a>    
            </button>
        </div>
    </header>
    <section class="py-16">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold">Why Choose EduVerse?</h2>
        </div>
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-2">Flexible Learning</h3>
                <p>Study at your own pace with our flexible online learning platform. Access course materials 24/7 from anywhere in the world.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-2">Expert Instructors</h3>
                <p>Learn from industry professionals and academic experts who bring real-world experience to your education.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-2">Recognized Certificates</h3>
                <p>Earn globally recognized certificates upon completion of your courses and boost your career prospects.</p>
            </div>
        </div>
    </section>
</body>
</html>