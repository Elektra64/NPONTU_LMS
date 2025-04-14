<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Enrollment | EduVerse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .payment-method.selected {
            border-color: #f59e0b;
            background-color: rgba(245, 158, 11, 0.1);
        }
        .package-option {
            transition: all 0.3s ease;
        }
        .package-option.selected {
            border-color: #f59e0b;
            box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.5);
        }
        body {
            position: relative;
            min-height: 100vh;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTh8fHRlY2glMjBsZWFybmluZ3xlbnwwfHwwfHx8MA%3D%3D');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -1;
            opacity: 0.3;
        }
        .content-wrapper {
            background-color: rgba(17, 24, 39, 0.9);
        }
        nav, footer {
            background-color: rgba(17, 24, 39, 0.95);
        }
    </style>
</head>
<body class="text-white font-sans">
    <!-- Navbar -->
    <x-navbar/>


    <!-- Enrollment Section -->
    <section class="container mx-auto px-4 py-16">
        <div class="max-w-3xl mx-auto">
            <div class="content-wrapper rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <i class="fas fa-check-circle text-5xl text-green-500 mb-4"></i>
                        <h2 class="text-3xl font-bold text-yellow-400 mb-2">Complete Your Enrollment</h2>
                        <p class="text-gray-300">You're almost there! Confirm your details to join the course</p>
                    </div>

                    <!-- Single Data Container -->
                    <div id="enrollmentData"
                        data-course='@json($successData['course'] ?? null)'
                        data-user='@json($successData['user'] ?? null)'
                        data-enrollment='@json($successData['enrollment'] ?? null)'
                        data-has-paid-options='{{ $successData['has_paid_options'] ?? false ? 'true' : 'false' }}'
                        data-complete-url='{{ route("enroll.complete", $successData["course"]["id"] ?? 0) }}'>
                    </div>

                    <!-- Course Info -->
                    <div class="bg-gray-700 bg-opacity-30 rounded-lg p-6 mb-8">
                        <h3 class="text-xl font-semibold mb-2">{{ $successData['course']['title'] ?? 'Course Title' }}</h3>
                        <div class="flex items-center text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <span class="ml-1 text-white">{{ $successData['course']['rating'] ?? 0 }}</span>
                            <span class="mx-2 text-gray-400">|</span>
                            <i class="fas fa-user-graduate text-gray-300"></i>
                            <span class="ml-1 text-gray-300">{{ number_format($successData['course']['students_count'] ?? 0) }} students</span>
                        </div>
                        <p class="text-gray-300">{{ $successData['course']['description'] ?? 'Course description' }}</p>
                    </div>

                    <!-- Package Selection (Only shown if course has paid options) -->
                    <div id="packageSelection" class="{{ $successData['has_paid_options'] ?? false ? '' : 'hidden' }} mb-8">
                        <h3 class="text-xl font-semibold mb-4">Select Your Package</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div id="freePackage" class="package-option bg-gray-700 p-6 rounded-lg border-2 border-transparent cursor-pointer selected">
                                <h4 class="font-bold text-lg mb-2">Free</h4>
                                <p class="text-gray-300 mb-4">Basic course access</p>
                                <div class="text-yellow-400 font-bold text-xl">$0.00</div>
                            </div>
                            <div id="standardPackage" class="package-option bg-gray-700 p-6 rounded-lg border-2 border-transparent cursor-pointer">
                                <h4 class="font-bold text-lg mb-2">Standard</h4>
                                <p class="text-gray-300 mb-4">Course + Quizzes</p>
                                <div class="text-yellow-400 font-bold text-xl">$49.99</div>
                            </div>
                            <div id="premiumPackage" class="package-option bg-gray-700 p-6 rounded-lg border-2 border-transparent cursor-pointer">
                                <h4 class="font-bold text-lg mb-2">Premium</h4>
                                <p class="text-gray-300 mb-4">Full access + Certificate</p>
                                <div class="text-yellow-400 font-bold text-xl">$99.99</div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Section -->
                    <div id="paymentSection" class="hidden">
                        <!-- Payment Methods -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold mb-4">Select Payment Method</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="payment-method bg-gray-700 p-4 rounded-lg border-2 border-transparent cursor-pointer">
                                    <div class="flex items-center">
                                        <i class="fab fa-cc-visa text-3xl text-blue-500 mr-3"></i>
                                        <span class="font-medium">Credit/Debit Card</span>
                                    </div>
                                </div>
                                <div class="payment-method bg-gray-700 p-4 rounded-lg border-2 border-transparent cursor-pointer">
                                    <div class="flex items-center">
                                        <i class="fab fa-paypal text-3xl text-blue-400 mr-3"></i>
                                        <span class="font-medium">PayPal</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Form -->
                        <div id="paymentForm" class="bg-gray-700 bg-opacity-30 rounded-lg p-6 mb-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-300 mb-2">Card Number</label>
                                    <input type="text" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="1234 5678 9012 3456">
                                </div>
                                <div>
                                    <label class="block text-gray-300 mb-2">Card Holder</label>
                                    <input type="text" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="John Doe">
                                </div>
                                <div>
                                    <label class="block text-gray-300 mb-2">Expiry Date</label>
                                    <input type="text" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="MM/YY">
                                </div>
                                <div>
                                    <label class="block text-gray-300 mb-2">CVV</label>
                                    <input type="text" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="123">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Details -->
                    <div class="mb-6 text-left">
                        <h3 class="text-xl font-semibold mb-4">Confirm Your Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-300 mb-2">Full Name</label>
                                <input type="text" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" value="{{ $successData['user']['name'] ?? 'John Doe' }}" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-300 mb-2">Email</label>
                                <input type="email" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" value="{{ $successData['user']['email'] ?? 'john@example.com' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Submit Section -->
                    <div class="mb-6">
                        <div class="flex items-start mb-4">
                            <input type="checkbox" id="terms" class="mt-1 mr-3" required>
                            <label for="terms" class="text-gray-300 text-sm">
                                I agree to the <a href="#" class="text-yellow-400 hover:underline">Terms of Service</a> and <a href="#" class="text-yellow-400 hover:underline">Privacy Policy</a>.
                            </label>
                        </div>
                        <button id="completeEnrollment" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg transition duration-300">
                            Complete Enrollment <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- Enhanced Footer -->
  <x-footer/>



    <script src="{{ asset('assets/js/success.js') }}"></script>
</body>
</html>
