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
            background-color: #F7FAFC;
            background-image: radial-gradient(#A1DBF1 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .form-container {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.85);
        }

        .role-option {
            transition: all 0.3s ease;
        }

        .role-option:hover {
            transform: translateY(-3px);
        }

        .role-option input:checked+div {
            border-color: #4A5568;
            background-color: rgba(74, 85, 104, 0.05);
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
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <!-- Animated background elements -->
        <div class="absolute top-20 left-10 w-16 h-16 rounded-full bg-primary/10 animate-float"
            style="animation-delay: 0s;"></div>
        <div class="absolute top-1/3 right-20 w-24 h-24 rounded-full bg-secondary/10 animate-float"
            style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-1/4 w-20 h-20 rounded-full bg-accent-light/10 animate-float"
            style="animation-delay: 2s;"></div>
        <div class="absolute top-1/4 right-1/3 w-12 h-12 rounded-full bg-fine-color/20 animate-float"
            style="animation-delay: 3s;"></div>
    </div>

    <div
        class="form-container relative z-10 w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
        <div class="bg-primary p-6 text-center">
            <div class="flex justify-center items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h1 class="text-2xl font-bold text-blue-600  text-center">EduVerse</h1>

            </div>
            <p class="text-accent-light/90">📚 Step into EduVerse – Your Gateway to Knowledge! Sign up now and explore a
                universe of opportunities.</p>

        </div>

        <form class="p-6 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Please fix the following errors:
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="space-y-4">
                <div class="flex flex-row justify-between items-center gap-4">
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input id="firstName" type="text" name="firstName" required autocomplete="name"
                            class="w-[100%] px-4 py-2 rounded-lg border border-gray-300 focus:border-primary focus:ring focus:ring-primary/50 transition">
                    </div>
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input id="lastName" type="text" name="lastName" required autocomplete="name"
                            class="w-[100%] px-4 py-2 rounded-lg border border-gray-300 focus:border-primary focus:ring focus:ring-primary/50 transition">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input id="email" type="email" name="email" required autocomplete="email"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-primary focus:ring focus:ring-primary/50 transition">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-primary focus:ring focus:ring-primary/50 transition">
                </div>


            </div>

            <div class="space-y-3">
                <p class="text-sm font-medium text-gray-700">I am signing up as:</p>
                <div class="grid grid-cols-2 gap-4">
                    <label class="role-option cursor-pointer">
                        <input type="radio" name="role" value="learner" class="hidden" checked>
                        <div class="p-4 border-2 border-gray-200 rounded-lg flex flex-col items-center transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary mb-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="font-medium">Learner</span>
                        </div>
                    </label>
                    <label class="role-option cursor-pointer">
                        <input type="radio" name="role" value="admin" class="hidden">
                        <div class="p-4 border-2 border-gray-200 rounded-lg flex flex-col items-center transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary mb-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            <span class="font-medium">Admin</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="flex items-center">
                <input id="terms" name="terms" type="checkbox" required
                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                <label for="terms" class="ml-2 block text-sm text-gray-700">
                    I agree to the <a href="#" class="text-primary hover:underline">Terms</a> and <a
                        href="#" class="text-primary hover:underline">Privacy Policy</a>
                </label>
            </div>

            <div>
                <button type="submit"
                    class="w-full py-3 px-4 bg-blue-900 hover:bg-secondary text-white font-medium rounded-lg transition duration-300 transform hover:scale-105">
                    Create Account
                </button>
            </div>

            <div class="text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">Sign in</a>
            </div>
        </form>
    </div>
</body>

</html>
