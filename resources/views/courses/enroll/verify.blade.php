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
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans">
    <!-- Navigation (same as your other pages) -->
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

            <div class="p-4 bg-yellow-100 text-black mb-4">
                <p>Debug Info:</p>
                <p>Course ID: {{ $course['id'] }}</p>
                <p>Generated URL: {{ route('enroll.verify', ['courseId' => $course['id']]) }}</p>
            </div>
            <div class="mt-8">
                <form method="POST" action="{{ route('enroll.verify', ['courseId' => $course['id']]) }}" class="mt-8">
                    @csrf
                    <div class="mb-6">
                        <div id="puzzleContainer" class="grid grid-cols-3 gap-2 mb-4"></div>
                        <div id="targetContainer" class="grid grid-cols-3 gap-2 bg-gray-700 p-4 rounded-lg"></div>
                        <input type="hidden" name="puzzle_solution" id="puzzleSolution">
                    </div>

                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg transition duration-300">
                        Verify Now <i class="fas fa-check ml-2"></i>
                    </button>
                </form>
                <div class="fixed bottom-0 left-0 bg-red-500 text-white p-4 z-50">
                Debug URL: {{ route('enroll.verify', ['courseId' => $course['id']]) }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Remove the src attribute if using inline script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        try {
            const puzzleContainer = document.getElementById('puzzleContainer');
            const targetContainer = document.getElementById('targetContainer');
            const solutionInput = document.getElementById('puzzleSolution');

            if (!puzzleContainer || !targetContainer || !solutionInput) {
                throw new Error('Missing required elements');
            }

            const pieces = ['A', 'B', 'C', 'D', 'E', 'F'];
            let correctOrder = [...pieces];
            let currentOrder = [...pieces].sort(() => Math.random() - 0.5);

            // Create puzzle pieces
            currentOrder.forEach(piece => {
                const pieceElement = document.createElement('div');
                pieceElement.className = 'puzzle-piece bg-yellow-500 text-black font-bold text-xl flex items-center justify-center h-16 rounded-lg cursor-move';
                pieceElement.textContent = piece;
                pieceElement.draggable = true;
                pieceElement.dataset.value = piece;

                pieceElement.addEventListener('dragstart', function(e) {
                    e.dataTransfer.setData('text/plain', e.target.dataset.value);
                    setTimeout(() => e.target.classList.add('opacity-0'), 0);
                });

                puzzleContainer.appendChild(pieceElement);
            });

            // Rest of your code...
        } catch (error) {
            console.error('Puzzle initialization failed:', error);
        }
    });
</script>
</body>
</html>
