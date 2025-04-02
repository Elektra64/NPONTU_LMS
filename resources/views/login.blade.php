<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/login.js') }}"></script>
    <style>
        body {
            background-color: #F7FAFC;
            background-image:
                radial-gradient(circle at 10% 20%, rgba(161, 219, 241, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(113, 128, 150, 0.1) 0%, transparent 20%);
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
        }

        .form-container {
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 32px rgba(74, 85, 104, 0.1);
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 0%;
            }

            50% {
                background-position: 100% 100%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .input-field {
            transition: all 0.3s ease;
            background-color: rgba(247, 250, 252, 0.7);
        }

        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(74, 85, 104, 0.2);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Animated background elements -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/5 w-16 h-16 rounded-full bg-primary/10 animate-float"
            style="animation-delay: 0s;"></div>
        <div class="absolute top-1/3 right-1/4 w-24 h-24 rounded-full bg-secondary/10 animate-float"
            style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 left-1/3 w-20 h-20 rounded-full bg-accent-light/10 animate-float"
            style="animation-delay: 4s;"></div>
    </div>

    <div class="form-container relative z-10 w-full max-w-md rounded-2xl overflow-hidden border border-gray-200/50">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-primary to-secondary p-8 text-center">
            <div class="flex justify-center items-center space-x-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h1 class="text-3xl font-bold text-blue-700">EduVerse</h1>
            </div>
            <p class="text-accent-light/90">🌟 EduVerse: Where Knowledge Meets You! Sign in and unlock limitless
                learning opportunities.</p>
        </div>

        <!-- Login Form -->
        <form class="p-8 space-y-6" method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input id="email" type="email" name="email" required autocomplete="email"
                        class="w-full px-4 py-3 rounded-lg input-field border border-gray-300 focus:border-primary focus:ring-0 transition">
                </div>

                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 rounded-lg input-field border border-gray-300 focus:border-primary focus:ring-0 transition pr-10">

                    <!-- Eye Icon -->
                    <span class="absolute inset-y-0 right-3 mt-6 flex items-center cursor-pointer"
                        onclick="togglePassword()">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </span>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-primary hover:underline">
                            Forgot password?
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-blue-700 to-blue-200 hover:from-primary/90 hover:to-secondary/90 text-white font-medium rounded-lg transition duration-300 transform hover:scale-[1.02] shadow-md">
                    Sign In
                </button>
            </div>

            <!-- Social Login Options -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <a href="#"
                    class="flex items-center justify-center space-x-2 p-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Facebook</span>
                </a>

                <a href="#"
                    class="flex items-center justify-center space-x-2 p-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z" />
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Google</span>
                </a>
            </div>

            <div class="text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('signUp') }}" class="text-primary font-medium hover:underline">Sign up</a>
            </div>
        </form>
    </div>
</body>

</html>
