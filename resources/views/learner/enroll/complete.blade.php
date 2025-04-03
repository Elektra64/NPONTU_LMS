<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Complete | EduVerse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="text-white font-sans"
    style="background-image: url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=1920&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTh8fHRlY2glMjBsZWFybmluZ3xlbnwwfHwwfHx8MA%3D%3D');
             background-size: cover;
             background-position: center;
             background-repeat: no-repeat;">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white p-4 flex justify-between items-center sticky top-0 z-50 shadow-lg">
        <div class="flex items-center space-x-8">
            <span class="text-2xl font-bold text-yellow-400 flex items-center">
                <a href="/home" class="cursor-pointer">
                    <i class="fas fa-graduation-cap mr-2"></i>EduVerse
                </a>
            </span>
        </div>
    </nav>

    <!-- Completion Content -->
    <section class="container mx-auto px-4 py-16">
        <div
            class="max-w-2xl mx-auto bg-gray-800 bg-opacity-50 backdrop-filter backdrop-blur-lg rounded-xl shadow-lg overflow-hidden p-8 text-center">
            <div class="mb-6">
                <i class="fas fa-check-circle text-6xl text-green-500 mb-4"></i>
                <h2 class="text-3xl font-bold text-yellow-400 mb-2">Enrollment Complete!</h2>
                <p class="text-white">You have successfully enrolled in <strong>Course Title</strong></p>
            </div>

            <div class="flex flex-col space-y-4">
                <a href="#"
                    class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg transition duration-300">
                    Continue to Course <i class="fas fa-arrow-right ml-2"></i>
                </a>

                <a href="{{ route('published.courses') }}"
                    class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    Browse More Courses
                </a>
            </div>
        </div>
    </section>
</body>

</html>
