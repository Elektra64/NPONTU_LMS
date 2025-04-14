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
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="200" height="80" viewBox="0 0 200 80"><path d="M10,40 Q50,10 90,40 T170,40" stroke="%23d1d5db" fill="none" stroke-width="2" stroke-dasharray="5,3"/></svg>') no-repeat center;
        }
        .certificate-bg {
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.95) 100%);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
      <!-- Enhanced Navbar -->
      <x-navbar />


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
       <x-footer/>

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
