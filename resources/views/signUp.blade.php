<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse - Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/signup.js') }}"></script>
    <style>
        body {
            background-color: #111827;
            background-image: radial-gradient(rgba(245, 158, 11, 0.2) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .form-container {
            backdrop-filter: blur(10px);
            background-color: rgba(31, 41, 55, 0.9);
            border-color: rgba(75, 85, 99, 0.5);
        }

        .role-option {
            transition: all 0.3s ease;
        }

        .role-option:hover {
            transform: translateY(-3px);
        }

        .role-option input:checked+div {
            border-color: #f59e0b;
            background-color: rgba(245, 158, 11, 0.1);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <!-- Animated background elements -->
        <div class="absolute top-20 left-10 w-16 h-16 rounded-full bg-yellow-400/10 animate-float" style="animation-delay: 0s;"></div>
        <div class="absolute top-1/3 right-20 w-24 h-24 rounded-full bg-gray-600/10 animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-1/4 w-20 h-20 rounded-full bg-yellow-400/10 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/4 right-1/3 w-12 h-12 rounded-full bg-yellow-400/20 animate-float" style="animation-delay: 3s;"></div>
    </div>

    <div class="form-container relative z-10 w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border">
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-6 text-center border-b border-gray-700">
            <div class="flex justify-center items-center space-x-3">
                <i class="fas fa-graduation-cap text-yellow-400 text-4xl"></i>
                <h1 class="text-2xl font-bold text-white">EduVerse</h1>
            </div>
            <p class="text-white">📚 Step into EduVerse – Your Gateway to Knowledge! Sign up now and explore a universe of opportunities.</p>
        </div>

        <form class="p-6 space-y-6" method="POST" action="{{ route('signUp') }}">
            @csrf

            <div class="space-y-4">
                <div class="flex flex-row justify-between items-center gap-4">
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-300 mb-1">First Name</label>
                        <input id="firstName" type="text" name="firstName" required autocomplete="name"
                            class="w-[100%] px-4 py-2 rounded-lg border border-gray-600 focus:border-yellow-400 focus:ring focus:ring-yellow-400/30 transition bg-gray-800 text-white">
                    </div>
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-300 mb-1">Last Name</label>
                        <input id="lastName" type="text" name="lastName" required autocomplete="name"
                            class="w-[100%] px-4 py-2 rounded-lg border border-gray-600 focus:border-yellow-400 focus:ring focus:ring-yellow-400/30 transition bg-gray-800 text-white">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                    <input id="email" type="email" name="email" required autocomplete="email"
                        class="w-full px-4 py-2 rounded-lg border border-gray-600 focus:border-yellow-400 focus:ring focus:ring-yellow-400/30 transition bg-gray-800 text-white">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full px-4 py-2 rounded-lg border border-gray-600 focus:border-yellow-400 focus:ring focus:ring-yellow-400/30 transition bg-gray-800 text-white">
                </div>
            </div>

            <div class="space-y-3">
                <p class="text-sm font-medium text-gray-300">I am signing up as:</p>
                <div class="grid grid-cols-2 gap-4">
                    <label class="role-option cursor-pointer">
                        <input type="radio" name="role" value="learner" class="hidden" checked>
                        <div class="p-4 border-2 border-gray-700 rounded-lg flex flex-col items-center transition-all bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="font-medium text-gray-200">Learner</span>
                        </div>
                    </label>
                    <label class="role-option cursor-pointer">
                        <input type="radio" name="role" value="admin" class="hidden">
                        <div class="p-4 border-2 border-gray-700 rounded-lg flex flex-col items-center transition-all bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            <span class="font-medium text-gray-200">Admin</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="flex items-center">
                <input id="terms" name="terms" type="checkbox" required
                    class="h-4 w-4 text-yellow-400 focus:ring-yellow-400 border-gray-600 rounded bg-gray-800">
                <label for="terms" class="ml-2 block text-sm text-gray-300">
                    I agree to the <a href="#" class="text-yellow-400 hover:underline">Terms</a> and <a href="#" class="text-yellow-400 hover:underline">Privacy Policy</a>
                </label>
            </div>

            <div>
                <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-gray-900 font-medium rounded-lg transition duration-300 transform hover:scale-105">
                    Create Account
                </button>
            </div>

            <div class="text-center text-sm text-gray-400">
                Already have an account?
                <a href="{{ route('login') }}" class="text-yellow-400 font-medium hover:underline">Sign in</a>
            </div>
        </form>
    </div>
</body>

</html>
