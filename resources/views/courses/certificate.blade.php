<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion | EduVerse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @media print {
            body {
                padding: 0;
                margin: 0;
                background: white !important;
            }
            nav, footer, .no-print, #puzzleModal {
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
        .puzzle-piece {
            transition: all 0.3s ease;
            cursor: move;
        }
        .puzzle-piece:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .puzzle-slot {
            background-color: #f3f4f6;
            border: 2px dashed #9ca3af;
            border-radius: 0.5rem;
        }
        nav {
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .share-dropdown {
            display: none;
            position: absolute;
            right: 0;
            bottom: 100%;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 0.5rem;
            min-width: 200px;
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
                        <img src="https://randomuser.me/api/portraits/men/32.jpg"
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
                        <h2 class="text-5xl font-bold text-gray-900 mb-3">{{ $certificate['user']['name'] }}</h2>
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
                                <img src="{{ $certificate['institution']['seal'] }}"
                                     alt="Organization Seal"
                                     class="h-full mx-auto">
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
                <a href="{{ route('certificate.show', ['enrollment' => $certificate['enrollment_id'], 'download' => true]) }}"
                   class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 rounded-lg shadow-md flex items-center transition">
                    <i class="fas fa-download mr-2"></i> Download Certificate
                </a>

                <div class="share-container relative">
                    <button id="shareBtn" class="px-6 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-lg shadow-md flex items-center transition">
                        <i class="fas fa-share-alt mr-2"></i> Share Achievement
                    </button>
                    <div class="share-dropdown">
                        <button onclick="shareCertificate('facebook', '{{ $share_url }}')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center">
                            <i class="fab fa-facebook-f text-blue-600 mr-2"></i> Facebook
                        </button>
                        <button onclick="shareCertificate('twitter', '{{ $share_url }}')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center">
                            <i class="fab fa-twitter text-blue-400 mr-2"></i> Twitter
                        </button>
                        <button onclick="shareCertificate('linkedin', '{{ $share_url }}')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center">
                            <i class="fab fa-linkedin-in text-blue-700 mr-2"></i> LinkedIn
                        </button>
                        <button onclick="shareCertificate('whatsapp', '{{ $share_url }}')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center">
                            <i class="fab fa-whatsapp text-green-500 mr-2"></i> WhatsApp
                        </button>
                        <button onclick="copyCertificateLink('{{ $share_url }}')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center">
                            <i class="fas fa-link text-gray-600 mr-2"></i> Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-bold flex items-center">
                        <i class="fas fa-graduation-cap text-yellow-400 mr-2"></i>
                        EduVerse LMS
                    </h3>
                    <p class="text-gray-400 mt-1">Empowering lifelong learners</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-6 pt-6 text-center text-gray-500 text-sm">
                &copy; 2023 EduVerse Learning Platform. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Download Verification Puzzle Modal -->
    <div id="puzzleModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-bold mb-4 text-center">
                <i class="fas fa-puzzle-piece text-yellow-500 mr-2"></i>
                Verify Download
            </h3>
            <p class="text-gray-600 mb-4 text-center">
                Complete this puzzle to download your certificate
            </p>

            <div class="mb-6">
                <h4 class="font-medium mb-2">Arrange these pieces:</h4>
                <div class="grid grid-cols-3 gap-2 mb-4" id="puzzleContainer">
                    <!-- Puzzle pieces will be inserted here by JavaScript -->
                </div>

                <h4 class="font-medium mb-2">Into this pattern:</h4>
                <div class="grid grid-cols-3 gap-2 mb-4" id="targetContainer">
                    <!-- Target slots will be inserted here by JavaScript -->
                </div>
            </div>

            <div class="flex justify-center space-x-4">
                <button id="cancelBtn" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">
                    Cancel
                </button>
                <button id="verifyBtn" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded">
                    Verify & Download
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/certificate.js') }}"></script>
</body>
</html>
