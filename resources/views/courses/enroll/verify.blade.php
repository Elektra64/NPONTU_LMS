<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Enrollment | EduVerse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .puzzle-piece {
            transition: all 0.3s ease;
            user-select: none;
        }
        .target-slot {
            transition: background-color 0.3s ease;
            min-height: 4rem;
            border: 2px dashed rgba(255,255,255,0.2);
            border-radius: 0.5rem;
        }
        .target-slot.highlight {
            background-color: rgba(74, 222, 128, 0.2);
            border-color: rgba(74, 222, 128, 0.5);
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans">
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

    <!-- Verification Content -->
    <section class="container mx-auto px-4 py-16">
        <div class="max-w-2xl mx-auto bg-gray-800 bg-opacity-50 backdrop-filter backdrop-blur-lg rounded-xl shadow-lg overflow-hidden">
            <div class="p-8 text-center">
                <h2 class="text-3xl font-bold text-yellow-400 mb-2">Complete Verification</h2>
                <p class="text-gray-300">Prove you're human to continue enrollment in <strong>{{ $course['title'] }}</strong></p>

                <div class="mt-8">
                    <form method="POST" action="{{ route('enroll.verify.submit', ['courseId' => $course['id']]) }}" class="mt-8">
                        @csrf
                        <div class="mb-6">
                            <p class="text-gray-400 mb-4">Drag the pieces to reconstruct the puzzle in the correct order</p>

                            <div id="puzzleContainer" class="grid grid-cols-3 gap-2 mb-4"></div>
                            <div id="targetContainer" class="grid grid-cols-3 gap-2 bg-gray-700 p-4 rounded-lg"></div>
                            <input type="hidden" name="puzzle_solution" id="puzzleSolution">
                        </div>

                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg transition duration-300">
                            Verify Now <i class="fas fa-check ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/js/verify.js') }}"></script>
</body>
</html>
