<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion | EduVerse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <style>
        @media print {
            body {
                padding: 0;
                margin: 0;
                background: white !important;
            }
            nav, footer, .no-print, #puzzleModal, .name-form, .edit-name-btn {
                display: none !important;
            }
            .certificate-container {
                box-shadow: none !important;
                border: none !important;
                margin: 0 auto;
            }
            .certificate-bg {
                background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.95) 100%) !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
        .signature-placeholder {
            height: 80px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="200" height="80" viewBox="0 0 200 80"><path d="M10,40 Q50,10 90,40 T170,40" stroke="%23d1d5db" fill="none" stroke-width="2" stroke-dasharray="5,3"/></svg>') no-repeat center;
        }
        .certificate-bg {
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.95) 100%),
                        url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
        }
        .student-name-display {
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .edit-name-btn {
            position: absolute;
            right: 0;
            bottom: 0;
            transform: translateY(100%);
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .name-input-form {
            transition: all 0.3s ease;
        }
        .name-input {
            min-width: 400px;
            border-bottom: 2px solid #d1d5db;
        }
        .name-input:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
        }
        .share-container {
            position: relative;
            display: inline-block;
        }
        .share-dropdown {
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 0.375rem;
            right: 0;
            display: none;
        }
        .share-container:hover .share-dropdown {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Sticky Navigation Bar -->
    <nav class="bg-gray-900 text-white shadow-lg sticky top-0">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/home" class="flex items-center space-x-2">
                <i class="fas fa-graduation-cap text-yellow-400 text-2xl"></i>
                <span class="text-xl font-bold">EduVerse</span>
            </a>
            <div class="flex items-center space-x-6">
                <a href="/courses" class="hover:text-yellow-400 transition">
                    <i class="fas fa-book mr-1"></i> Courses
                </a>
                <a href="/dashboard" class="hover:text-yellow-400 transition">
                    <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                </a>
                <div class="relative group">
                    <button class="hover:text-yellow-400 transition flex items-center">
                        <img src="{{ $certificate['user']['avatar'] ?? 'https://randomuser.me/api/portraits/men/32.jpg' }}"
                             alt="User"
                             class="w-8 h-8 rounded-full border-2 border-yellow-400">
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block">
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                            <i class="fas fa-cog mr-2"></i> Settings
                        </a>
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Certificate Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="certificate-bg border-4 border-yellow-500 rounded-xl shadow-2xl overflow-hidden certificate-container">
                <!-- Gold Foil Header -->
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 px-8 py-6 text-center">
                    <h1 class="text-3xl font-bold text-gray-900">Certificate of Achievement</h1>
                    <p class="text-gray-800 mt-1">This certifies that</p>
                </div>

                <!-- Body Content -->
                <div class="px-10 py-12">
                    <!-- Learner Info -->
                    <div class="text-center mb-10">
                        <div class="student-name-display">
                            @if(request()->has('student_name'))
                                <h2 class="text-5xl font-bold text-gray-900 mb-3">{{ request()->input('student_name') }}</h2>
                                <a href="{{ route('course.completion', $certificate['course']['id']) }}"
                                   class="edit-name-btn bg-yellow-500 hover:bg-yellow-600 text-white rounded">
                                    <i class="fas fa-edit mr-1"></i> Edit Name
                                </a>
                            @else
                                <h2 class="text-5xl font-bold text-gray-900 mb-3">{{ $certificate['user']['name'] }}</h2>
                                <form method="GET" action="{{ route('course.completion', $certificate['course']['id']) }}"
                                      class="name-input-form absolute inset-0 flex flex-col items-center justify-center">
                                    <input type="text" name="student_name"
                                           value="{{ $certificate['user']['name'] }}"
                                           class="name-input text-4xl text-center bg-transparent outline-none pb-2 mb-4"
                                           required>
                                    <button type="submit"
                                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg">
                                        <i class="fas fa-save mr-2"></i> Save Custom Name
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div class="w-24 h-1 bg-yellow-400 mx-auto mb-4"></div>
                        <p class="text-xl text-gray-600">has successfully completed the course</p>
                    </div>

                    <!-- Course Info -->
                    <div class="text-center mb-12">
                        <h3 class="text-3xl font-semibold text-yellow-600">{{ $certificate['course']['title'] }}</h3>
                        <p class="text-gray-500 mt-3">
                            with distinction, achieving a score of
                            <span class="font-bold text-gray-700">{{ $certificate['completion_details']['score'] }}%</span>
                            (Grade: {{ $certificate['completion_details']['grade'] }})
                        </p>
                        <p class="text-gray-500 mt-2">
                            Completed on: {{ $certificate['completion_details']['completed_at'] }}
                        </p>
                    </div>

                    <!-- Signatures -->
                    <div class="flex justify-between mt-16 pt-8 border-t border-gray-200">
                        <div class="text-center w-1/3">
                            @if($certificate['institution']['signature'])
                                <img src="{{ $certificate['institution']['signature'] }}" alt="Instructor Signature" class="h-20 mx-auto mb-3">
                            @else
                                <div class="signature-placeholder mb-3 mx-auto"></div>
                            @endif
                            <p class="font-medium text-gray-700">{{ $certificate['instructor']['name'] }}</p>
                            <p class="text-sm text-gray-500">{{ $certificate['instructor']['title'] }}</p>
                        </div>

                        <div class="text-center w-1/3">
                            <div class="h-20 mb-3 mx-auto">
                                @if(!empty($certificate['institution']['seal']))
                                    <img src="{{ asset($certificate['institution']['seal']) }}"
                                        alt="Organization Seal"
                                        class="h-full mx-auto"
                                        onerror="this.onerror=null;this.src='https://unsplash.com/photos/a-gold-letter-with-a-green-background-Q-qBa2D9sdw'">
                                @else
                                    <!-- Fallback to a placeholder image -->
                                    <img src="https://unsplash.com/photos/a-gold-letter-with-a-green-background-Q-qBa2D9sdw"
                                        alt="Default Organization Seal"
                                        class="h-full mx-auto">
                                @endif
                            </div>
                            <p class="font-medium text-gray-700">{{ $certificate['institution']['name'] }}</p>
                            <p class="text-sm text-gray-500">Issuing Authority</p>
                        </div>

                        <div class="text-center w-1/3">
                            <div class="h-20 mb-3 mx-auto">
                                <img src="{{ $certificate['qr_code'] }}"
                                     alt="Verification QR Code"
                                     class="h-full mx-auto">
                            </div>
                            <p class="font-medium text-gray-700">ID: <span>{{ $certificate['certificate_info']['id'] }}</span></p>
                            <p class="text-sm text-gray-500">Issued: {{ $certificate['certificate_info']['issued_date'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Verification Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 text-center">
                    <p class="text-xs text-gray-500">
                        Verify authenticity at:
                        <span class="font-mono text-yellow-600">eduverse.com/verify/</span>
                        <span>{{ $certificate['certificate_info']['verification_code'] }}</span>
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-center space-x-4 no-print">
                <button id="downloadBtn" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 rounded-lg shadow-md flex items-center transition">
                    <i class="fas fa-download mr-2"></i> Download Certificate
                </button>

                <div class="share-container relative">
                    <button id="shareBtn" class="px-6 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-lg shadow-md flex items-center transition">
                        <i class="fas fa-share-alt mr-2"></i> Share Achievement
                    </button>
                    <div id="shareDropdown" class="share-dropdown">
                        <button onclick="shareCertificate('facebook')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center">
                            <i class="fab fa-facebook-f text-blue-600 mr-2"></i> Facebook
                        </button>
                        <button onclick="shareCertificate('twitter')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center">
                            <i class="fab fa-twitter text-blue-400 mr-2"></i> Twitter
                        </button>
                        <button onclick="shareCertificate('linkedin')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center">
                            <i class="fab fa-linkedin-in text-blue-700 mr-2"></i> LinkedIn
                        </button>
                        <button onclick="shareCertificate('whatsapp')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center">
                            <i class="fab fa-whatsapp text-green-500 mr-2"></i> WhatsApp
                        </button>
                        <button onclick="copyCertificateLink()" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center">
                            <i class="fas fa-link text-gray-600 mr-2"></i> Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-gray-800 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <!-- Column 1 -->
                <div>
                    <h3 class="text-xl font-bold text-yellow-400 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i> EduVerse
                    </h3>
                    <p class="text-gray-400 mb-4">Empowering learners worldwide with accessible, high-quality education since 2015.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Column 2 -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Home</a></li>
                        <li><a href="{{ route('courses.publishedCourse') }}" class="text-gray-400 hover:text-yellow-400 transition duration-300">Courses</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Instructors</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Pricing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Blog</a></li>
                    </ul>
                </div>

                <!-- Column 3 -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">FAQs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Cookie Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Column 4 -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Subscribe to get updates on new courses, discounts and special offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="bg-gray-700 text-white px-4 py-2 rounded-l focus:outline-none focus:ring-2 focus:ring-yellow-400 w-full">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-r transition duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                    <div class="mt-4 flex items-center text-gray-400">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span>+1 (555) 123-4567</span>
                    </div>
                    <div class="mt-2 flex items-center text-gray-400">
                        <i class="fas fa-envelope mr-2"></i>
                        <span>support@eduverse.com</span>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2023 EduVerse University. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-yellow-400 text-sm transition duration-300">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-yellow-400 text-sm transition duration-300">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-yellow-400 text-sm transition duration-300">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/certificate.js') }}">

    </script>
</body>
</html>
