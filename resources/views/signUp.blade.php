<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse - Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        .role-option input:checked + div {
            border-color: #4A5568;
            background-color: rgba(74, 85, 104, 0.05);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <!-- Animated background elements -->
        <div class="absolute top-20 left-10 w-16 h-16 rounded-full bg-primary/10 animate-float" style="animation-delay: 0s;"></div>
        <div class="absolute top-1/3 right-20 w-24 h-24 rounded-full bg-secondary/10 animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-1/4 w-20 h-20 rounded-full bg-accent-light/10 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/4 right-1/3 w-12 h-12 rounded-full bg-fine-color/20 animate-float" style="animation-delay: 3s;"></div>
    </div>

    <div class="form-container relative z-10 w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
        <div class="bg-primary p-6 text-center">
            <div class="flex justify-center items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h1 class="text-2xl font-bold text-blue-600  text-center">EduVerse</h1>

            </div>
            <p class="text-accent-light/90">📚 Step into EduVerse – Your Gateway to Knowledge! Sign up now and explore a universe of opportunities.</p>

        </div>

        <form class="p-6 space-y-6" method="POST" action="{{ route('signUp') }}">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input id="name" type="text" name="name" required autocomplete="name"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-primary focus:ring focus:ring-primary/50 transition">
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="font-medium">Learner</span>
                        </div>
                    </label>
                    <label class="role-option cursor-pointer">
                        <input type="radio" name="role" value="admin" class="hidden">
                        <div class="p-4 border-2 border-gray-200 rounded-lg flex flex-col items-center transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
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
                    I agree to the <a href="#" class="text-primary hover:underline">Terms</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>
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

    <script>
        // Add visual feedback for role selection
        document.querySelectorAll('.role-option input').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.role-option div').forEach(div => {
                    div.classList.remove('border-primary', 'bg-primary/5');
                });
                if (this.checked) {
                    this.nextElementSibling.classList.add('border-primary', 'bg-primary/5');
                }
            });
        });

        // Initialize the checked state
        document.querySelector('.role-option input:checked').nextElementSibling.classList.add('border-primary', 'bg-primary/5');
    </script>
</body>
</html>
