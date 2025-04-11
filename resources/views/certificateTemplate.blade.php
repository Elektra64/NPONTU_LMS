<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @media print {
            body {
                padding: 0;
                margin: 0;
                background: white !important;
            }
            nav, footer, .no-print {
                display: none !important;
            }
            .certificate-container {
                box-shadow: none !important;
                border: none !important;
                margin: 0 auto;
            }
            .certificate-bg {
                background: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
        .signature-placeholder {
            height: 80px;
            background: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAyMDAgODAiPjxwYXRoIGQ9Ik0xMCw0MCBRNTAsMTAgOTAsNDAgVDE3MCw0MCIgc3Ryb2tlPSIjZDFkNWVkYiIgZmlsbD0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtZGFzaGFycmF5PSI1LDMiLz48L3N2Zz4=") no-repeat center;
        }
        .certificate-bg {
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.95) 100%);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
      <!-- Enhanced Navbar -->
      <nav class="bg-gray-900 text-white p-4 flex justify-between items-center sticky top-0 z-50 shadow-lg">
    <div class="flex items-center space-x-8">
        <span class="text-2xl font-bold text-yellow-400 flex items-center">
            <a href="/home" class="cursor-pointer">
                <i class="fas fa-graduation-cap mr-2"></i>EduVerse
            </a>
        </span>
        <div class="hidden md:flex space-x-6">
            <!-- Unified Courses Entry -->
            <a href="{{ route('published.courses') }}" class="hover:text-yellow-400 transition duration-300 flex items-center">
                <i class="fas fa-book-open mr-2"></i>Courses
            </a>

            <!-- Learning Tools -->
            <a href="#" class="hover:text-yellow-400 transition duration-300 flex items-center">
                <i class="fas fa-tasks mr-2"></i>Learning
            </a>


        </div>
    </div>
    <div class="flex items-center space-x-4">
        <!-- Quick Access Dropdown -->
        <div class="relative group">
            <button class="hover:text-yellow-400 px-3 py-1 rounded-lg transition duration-300 flex items-center">
                <i class="fas fa-bolt mr-2"></i> Quick Access
                <i class="fas fa-chevron-down ml-1 text-xs"></i>
            </button>
            <div class="absolute hidden group-hover:block bg-gray-800 mt-2 py-2 w-48 rounded shadow-lg z-50 right-0">
                <a href="{{ route('published.courses') }}" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-search mr-2"></i> Browse Catalog
                </a>

                <a href="#" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-certificate mr-2"></i> Certificates
                </a>
            </div>
        </div>


    </div>
    <div class="flex items-center space-x-4">
        <!-- Notification Bell -->
        <a href="#" class="p-2 rounded-full hover:bg-gray-700 relative">
            <i class="fas fa-bell"></i>
            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-yellow-400"></span>
        </a>

        <!-- User Menu -->
        <div class="user-badge flex items-center space-x-3 bg-gray-800 px-3 py-1 rounded-full cursor-pointer hover:bg-gray-700">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-medium">John Doe</div>
                <div class="text-xs text-gray-400">Learner</div>
            </div>
            <div class="relative">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User profile" class="w-8 h-8 rounded-full border-2 border-yellow-400">
            </div>
        </div>
    </div>
</nav>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="certificate-bg border-4 border-yellow-500 rounded-xl shadow-2xl overflow-hidden certificate-container">
                <!-- Header -->
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 px-8 py-6 text-center">
                    <h1 class="text-3xl font-bold text-gray-900">Certificate of Achievement</h1>
                    <p class="text-gray-800 mt-1">This certifies that</p>
                </div>

                <!-- Body Content -->
                <div class="px-10 py-12">
                    <!-- Student Info -->
                    <div class="text-center mb-10">
                        <h2 class="text-5xl font-bold text-gray-900 mb-3">[STUDENT NAME]</h2>
                        <div class="w-24 h-1 bg-yellow-400 mx-auto mb-4"></div>
                        <p class="text-xl text-gray-600">has successfully completed the course</p>
                    </div>

                    <!-- Course Info -->
                    <div class="text-center mb-12">
                        <h3 class="text-3xl font-semibold text-yellow-600">[COURSE TITLE]</h3>
                        <p class="text-gray-500 mt-3">
                            with distinction, achieving a score of
                            <span class="font-bold text-gray-700">[SCORE]%</span>
                            (Grade: [GRADE])
                        </p>
                        <p class="text-gray-500 mt-2">
                            Completed on: [COMPLETION DATE]
                        </p>
                    </div>

                    <!-- Signatures -->
                    <div class="flex justify-between mt-16 pt-8 border-t border-gray-200">
                        <div class="text-center w-1/3">
                            <div class="signature-placeholder mb-3 mx-auto"></div>
                            <p class="font-medium text-gray-700">[INSTRUCTOR NAME]</p>
                            <p class="text-sm text-gray-500">[INSTRUCTOR TITLE]</p>
                        </div>

                        <div class="text-center w-1/3">
                            <div class="h-20 mb-3 mx-auto">
                                <div class="h-full w-full bg-gray-200 mx-auto"></div>
                            </div>
                            <p class="font-medium text-gray-700">[INSTITUTION NAME]</p>
                            <p class="text-sm text-gray-500">Issuing Authority</p>
                        </div>

                        <div class="text-center w-1/3">
                            <div class="h-20 mb-3 mx-auto">
                                <div class="h-full w-full bg-gray-200 mx-auto"></div>
                            </div>
                            <p class="font-medium text-gray-700">ID: [CERTIFICATE ID]</p>
                            <p class="text-sm text-gray-500">Issued: [ISSUED DATE]</p>
                        </div>
                    </div>
                </div>

                <!-- Verification Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 text-center">
                    <p class="text-xs text-gray-500">
                        Verify authenticity at:
                        <span class="font-mono text-yellow-600">[YOURDOMAIN]/verify/</span>
                        <span>[VERIFICATION CODE]</span>
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-center space-x-4 no-print">
                <button onclick="window.print()" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 rounded-lg shadow-md flex items-center transition">
                    <i class="fas fa-download mr-2"></i> Download Certificate
                </button>

                <div class="relative">
                    <button id="shareBtn" class="px-6 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-lg shadow-md flex items-center transition">
                        <i class="fas fa-share-alt mr-2"></i> Share Achievement
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Footer -->
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
                        <li><a href="{{ route('published.courses') }}" class="text-gray-400 hover:text-yellow-400 transition duration-300">Courses</a></li>
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
    <script>
        // Simple share functionality
        document.getElementById('shareBtn').addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: 'Certificate of Completion',
                    text: 'I earned a certificate for completing [COURSE TITLE]!',
                    url: window.location.href,
                })
                .catch(err => console.log('Error sharing:', err));
            } else {
                alert('Web Share API not supported in your browser. Copy this URL: ' + window.location.href);
            }
        });
    </script>
</body>
</html>