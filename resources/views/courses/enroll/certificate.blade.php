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
        /* --- Base styles (Keep your original styles here or adapt as needed) --- */
        .certificate-container {
            background-color: white;
            border: 4px solid #2e7d32;
            border-radius: 12px;
            overflow: hidden; /* Helps contain children */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            position: relative;
            box-sizing: border-box; /* Ensure padding/border included in size */
        }
        .certificate-bg {
            position: relative;
            z-index: 1;
        }
        /* Blob decorations */
        .blob-top-right {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background-color: #2e7d32;
            border-radius: 50% 30% 70% 50%;
            z-index: 0;
            opacity: 0.8;
        }
        .blob-bottom-left {
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            background-color: #2e7d32;
            border-radius: 70% 50% 50% 30%;
            z-index: 0;
            opacity: 0.8;
        }
        /* Certificate header */
        .certificate-header {
            background: linear-gradient(to right, #2e7d32, #388e3c);
            color: white;
            padding: 1.5rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        .certificate-header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        /* Certificate body */
        .certificate-body {
            padding: 2rem 3rem;
            position: relative;
            z-index: 1;
        }
        /* Student info */
        .student-info {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .student-name-display {
            position: relative;
            min-height: 72px; /* Adjust if needed based on button/form */
            margin-bottom: 1rem;
        }
        .student-name {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }
        .divider {
            width: 100px;
            height: 4px;
            background-color: #2e7d32;
            margin: 1rem auto;
        }
        /* Course info */
        .course-info {
            text-align: center;
            margin-bottom: 3rem;
        }
        .course-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2e7d32;
            margin-bottom: 0.5rem;
        }
        /* Signatures section */
        .signatures {
            display: flex;
            justify-content: space-between;
            align-items: flex-end; /* Align items at the bottom */
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 1px solid #e0e0e0;
        }
        .signature-box {
            text-align: center;
            width: 30%;
        }
        .signature-placeholder {
            height: 60px;
            margin-bottom: 1rem;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="200" height="60" viewBox="0 0 200 60"><path d="M10,30 Q50,10 90,30 T170,30" stroke="%232e7d32" fill="none" stroke-width="2" stroke-dasharray="5,3"/></svg>') no-repeat center;
        }
        /* Certificate seal */
        .certificate-seal {
             margin: 0 auto 1rem auto; /* Add bottom margin */
             width: 80px;
             height: 80px;
        }
         .certificate-seal img, .certificate-seal svg {
             width: 100%;
             height: 100%;
             object-fit: contain;
         }
        /* Molecule styles */
        .molecule-left {
            position: absolute;
            top: 120px;
            left: 50px;
            z-index: 0;
        }
        .molecule-right {
            position: absolute;
            bottom: 80px;
            right: 50px;
            z-index: 0;
        }
        /* Verification Footer */
        .verification-footer {
            background-color: #f0f0f0;
            border-top: 1px solid #ddd;
            padding: 1rem;
            text-align: center;
            font-size: 0.8rem;
            color: #666;
        }
        /* Share dropdown and edit name styles */
        .share-container {
            position: relative;
            display: inline-block;
        }
        .share-dropdown {
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 50; /* Ensure dropdown is above other elements */
            border-radius: 0.375rem;
            right: 0;
            margin-top: 0.5rem; /* Space from button */
            display: none; /* Initially hidden */
        }
        /* Use JS to toggle visibility, hover might be finicky */
        .share-dropdown.visible {
            display: block;
        }
        .edit-name-btn {
            position: absolute;
            right: 0;
            bottom: -25px; /* Position below the name */
            /* transform: translateY(100%); Removed, using bottom positioning */
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            z-index: 10; /* Ensure button is clickable */
        }
        .name-input-form {
            transition: all 0.3s ease;
            /* Ensure form doesn't interfere when hidden */
        }
        .name-input {
            min-width: 400px; /* Or adjust as needed */
            border-bottom: 2px solid #d1d5db;
        }
        .name-input:focus {
            border-color: #f59e0b; /* Tailwind amber-500 */
            outline: none; /* Remove default focus outline */
            box-shadow: none; /* Remove default focus shadow if any */
        }
        /* Style for the name input form wrapper when active */
         .student-name-display form {
             /* Styles for the form container */
             padding-top: 1rem; /* Add some space when form is visible */
         }

        /* --- PRINT STYLES --- */
        @page {
            size: A4 portrait; /* Or 'Letter portrait' */
            margin: 1cm; /* Adjust margins as needed */
        }

        @media print {
            html, body {
                padding: 0 !important;
                margin: 0 !important;
                background: white !important; /* Ensure white background */
                width: 100%;
                height: 100%;
                overflow: hidden !important; /* Prevent scrollbars affecting print layout */
                -webkit-print-color-adjust: exact !important; /* Force color printing */
                print-color-adjust: exact !important; /* Standard property */
            }
            nav, footer, .no-print, #puzzleModal, .name-input-form, .edit-name-btn, .share-container {
                display: none !important; /* Hide non-certificate elements including edit/share */
            }

            .certificate-container {
                box-shadow: none !important;
                border: 4px solid #2e7d32 !important; /* Keep border visible */
                margin: 0 auto !important; /* Center on the page */
                width: 100% !important; /* Fit within page margins set by @page */
                height: auto !important; /* Let content determine height */
                max-height: 100% !important; /* Try to fit on one page */
                page-break-inside: avoid !important; /* CRUCIAL: Prevent breaking container across pages */
                overflow: hidden !important; /* Hide any minor overflow within the container */
                position: relative !important; /* Reset position if needed */
                top: 0 !important;
                left: 0 !important;
                border-radius: 12px !important; /* Keep rounded corners if desired */
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .certificate-header {
                background: linear-gradient(to right, #2e7d32, #388e3c) !important; /* Force background */
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color: white !important; /* Ensure text color */
            }

            .certificate-body {
                padding: 1.5rem 2rem !important; /* Slightly reduce padding for print if needed */
                position: relative !important;
                z-index: 1 !important;
            }

            .certificate-bg {
                /* If using a background image/gradient here, ensure it's forced */
                background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.95) 100%) !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Option 1: Keep decorative elements but ensure they print */
            .blob-top-right, .blob-bottom-left, .molecule-left, .molecule-right {
                background-color: #2e7d32 !important; /* Force background color */
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                opacity: 0.6 !important; /* Reduce opacity slightly if they obscure text */
                z-index: 0 !important; /* Ensure they are behind content */
            }
            .molecule-left svg *, .molecule-right svg * {
                 fill: #2e7d32 !important; /* Force fill colors */
                 -webkit-print-color-adjust: exact !important;
                 print-color-adjust: exact !important;
            }
            /* Force specific colors within molecules */
            .molecule-left svg circle[fill="#fdd835"], .molecule-right svg circle[fill="#fdd835"] { fill: #fdd835 !important; }
            .molecule-left svg circle[fill="#e53935"], .molecule-right svg circle[fill="#e53935"] { fill: #e53935 !important; }


            /* Option 2: Hide potentially problematic decorative elements for print */
            /*
            .blob-top-right, .blob-bottom-left, .molecule-left, .molecule-right {
                display: none !important;
            }
            */

            /* Ensure images print correctly */
            img {
                max-width: 100% !important; /* Prevent images from overflowing */
                height: auto !important;
                -webkit-print-color-adjust: exact !important; /* May help complex images/SVGs */
                print-color-adjust: exact !important;
            }
            .signature-box img, .certificate-seal img, .signature-box .h-20 img {
                max-height: 60px !important; /* Control height of signature/seal/qr IMAGE */
                width: auto !important;
                object-fit: contain !important;
            }
             .signature-box .h-20 { /* Target the CONTAINER for QR */
                 height: 60px !important; /* Set container height */
                 width: 60px !important; /* Set container width to make QR square */
                 margin-left: auto;
                 margin-right: auto;
             }
             .signature-box .h-20 img { /* Ensure image fills the container */
                 height: 100% !important;
                 width: 100% !important;
             }

            .certificate-seal {
                width: 70px !important; /* Explicit size for seal container */
                height: 70px !important;
            }
            .kalabash {
                width: 70px !important; /* Explicit size for seal container */
            }

            /* Ensure SVGs render colors */
            svg, svg * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            /* Force specific SVG colors if needed (examples) */
            .certificate-seal svg circle[stroke="#2e7d32"] { stroke: #2e7d32 !important; }
            .certificate-seal svg path[stroke="#2e7d32"] { stroke: #2e7d32 !important; }
            .certificate-seal svg circle[fill="#fdd835"] { fill: #fdd835 !important; }
            /* Medal SVG */
            div[style*="text-align: center"] svg circle { stroke: #2e7d32 !important; fill: none !important; }
            div[style*="text-align: center"] svg path { stroke: #2e7d32 !important; }


            /* Adjust font sizes slightly if needed to fit */
            .student-name {
                font-size: 2.2rem !important;
            }
            .course-title {
                font-size: 1.6rem !important;
            }
            /* Add other font-size adjustments if necessary */
            p, .signature-box p, .verification-footer p {
                 font-size: 0.9rem !important; /* Slightly smaller base text */
                 line-height: 1.4 !important; /* Adjust line height */
            }
            .student-info > p:last-of-type { /* Target the long description text */
                font-size: 0.85rem !important;
            }


            /* Ensure signature placeholder renders */
            .signature-placeholder {
                background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="200" height="60" viewBox="0 0 200 60"><path d="M10,30 Q50,10 90,30 T170,30" stroke="%232e7d32" fill="none" stroke-width="2" stroke-dasharray="5,3"/></svg>') no-repeat center !important;
                background-size: contain !important; /* Ensure it scales if needed */
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                height: 60px !important; /* Keep height consistent */
            }
             /* Adjust signature vertical spacing if needed */
            .signatures {
                 margin-top: 2rem !important;
                 padding-top: 1rem !important;
            }
        }
        /* --- End PRINT STYLES --- */

    </style>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-gray-900 text-white shadow-lg sticky top-0 z-50 no-print">
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

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="certificate-container">
                <div class="blob-top-right"></div>
                <div class="blob-bottom-left"></div>

                <div class="molecule-left">
                <img  src="https://www.npontu.com/assets/images/npontu_logo.png" width="70px" class=" mt-5">

                </div>

                <div class="certificate-header">
                    <h1 class="font-bold">CERTIFICATE</h1>
                    <p>OF COMPLETION</p>
                </div>

                <div class="certificate-body certificate-bg">
                    <div class="student-info">
                        <p>PRESENTED TO:</p>
                        <div class="student-name-display">
                            {{-- NOTE: This logic shows name or edit form based on query param --}}
                            {{-- For printing, only the final name should ideally be shown --}}
                            @if(request()->has('student_name'))
                                <h2 class="student-name">{{ request()->input('student_name') }}</h2>
                                <a href="{{ route('course.completion', $certificate['course']['id']) }}"
                                   class="edit-name-btn bg-yellow-500 hover:bg-yellow-600 text-white rounded no-print">
                                    <i class="fas fa-edit mr-1"></i> Edit Name
                                </a>
                            @else
                                {{-- Default view showing name, form might be hidden by JS/CSS --}}
                                <h2 class="student-name">{{ $certificate['user']['name'] }}</h2>
                                {{-- The form below should ideally be hidden by default and shown via JS if needed --}}
                                {{-- Added 'no-print' class to hide form during print --}}
                                <form method="GET" action="{{ route('course.completion', $certificate['course']['id']) }}"
                                      class="name-input-form absolute inset-0 flex flex-col items-center justify-center no-print" style="/* display: none; */"> {{-- Initially hide form? --}}
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
                        <div class="divider"></div>
                        <p>WHO HAS SUCCESSFULLY COMPLETED THE REQUIREMENTS FOR THE COURSE</p> {{-- Simplified text a bit --}}
                    </div>

                    <div class="course-info">
                        <h3 class="course-title">{{ $certificate['course']['title'] }}</h3>
                        <p>with distinction, achieving a score of <strong>{{ $certificate['completion_details']['score'] }}%</strong> (Grade: {{ $certificate['completion_details']['grade'] }})</p>
                        <p>Completed on: {{ $certificate['completion_details']['completed_at'] }}</p>
                    </div>

                    <div style="text-align: center; margin: 2rem 0;">
                        <svg width="70" height="70" viewBox="0 0 70 70">
                            <circle cx="35" cy="35" r="25" fill="none" stroke="#2e7d32" stroke-width="2" />
                            <circle cx="35" cy="35" r="20" fill="none" stroke="#2e7d32" stroke-width="2" />
                            <path d="M35 50 L35 70" stroke="#2e7d32" stroke-width="2" />
                            <path d="M30 55 L40 55" stroke="#2e7d32" stroke-width="2" />
                            <path d="M25 65 L45 65" stroke="#2e7d32" stroke-width="2" />
                        </svg>
                    </div>

                    <div class="signatures">
                        <div class="signature-box">
                            {{-- Instructor Signature --}}
                            @if($certificate['institution']['signature']) {{-- Assuming institution signature path --}}
                                <img src="{{ $certificate['institution']['signature'] }}" alt="Instructor Signature" class="h-16 mx-auto mb-3 object-contain"> {{-- Adjusted height --}}
                            @else
                                <div class="signature-placeholder"></div>
                            @endif
                            <p><strong>{{ $certificate['instructor']['name'] }}</strong></p>
                            <p>{{ $certificate['instructor']['title'] }}</p>
                        </div>

                        <div class="signature-box">
                            {{-- Seal --}}
                            <div class="certificate-seal">
                                @if(!empty($certificate['institution']['seal']))
                                    <img src="{{ asset($certificate['institution']['seal']) }}"
                                         alt="Organization Seal">
                                         {{-- Removed onerror placeholder for cleaner print --}}
                                @else
                                    {{-- Fallback SVG Seal --}}
                                    <svg viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="45" fill="none" stroke="#2e7d32" stroke-width="2" />
                                        <circle cx="50" cy="50" r="35" fill="none" stroke="#2e7d32" stroke-width="2" />
                                        <path d="M30,50 L70,50" stroke="#2e7d32" stroke-width="2" />
                                        <path d="M50,30 L50,70" stroke="#2e7d32" stroke-width="2" />
                                        <circle cx="50" cy="50" r="10" fill="#fdd835" />
                                    </svg>
                                @endif
                            </div>
                            <p><strong>{{ $certificate['institution']['name'] }}</strong></p>
                            <p>Issuing Authority</p>
                        </div>

                        <div class="signature-box">
                            {{-- QR Code and ID --}}
                            <div class="h-15 mb-3 mx-auto"> {{-- Container for QR --}}
                                <img class= "h-15" src="{{ $certificate['qr_code'] }}"
                                     alt="Verification QR Code">
                            </div>
                            <p><strong>ID: {{ $certificate['certificate_info']['id'] }}</strong></p>
                            <p>Issued: {{ $certificate['certificate_info']['issued_date'] }}</p>
                        </div>
                    </div>

                    <div class="molecule-right" >
                        <img class= "kalabash" src="https://www.npontu.com/assets/images/npontu_logo.png" width="70px">
                        <!-- <svg width="80" height="60" viewBox="0 0 80 60">
                            <circle cx="40" cy="30" r="18" fill="#2e7d32" />
                            <circle cx="65" cy="15" r="10" fill="#fdd835" />
                            <circle cx="20" cy="15" r="7" fill="#e53935" />
                        </svg> -->
                    </div>
                </div>

                <div class="verification-footer">
                    <p>
                        Verify authenticity at:
                        <span style="font-family: monospace; color: #2e7d32;">eduverse.com/verify/</span>
                        <span>{{ $certificate['certificate_info']['verification_code'] }}</span>
                    </p>
                </div>
            </div>

            <div class="mt-8 flex justify-center space-x-4 no-print">
                <button id="downloadBtn" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 rounded-lg shadow-md flex items-center transition text-gray-900">
                    <i class="fas fa-download mr-2"></i> Download Certificate
                </button>

                <div class="share-container relative">
                    <button id="shareBtn" class="px-6 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-lg shadow-md flex items-center transition">
                        <i class="fas fa-share-alt mr-2"></i> Share Achievement
                    </button>
                    <div id="shareDropdown" class="share-dropdown hidden"> {{-- Start hidden --}}
                        <button onclick="shareCertificate('facebook')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center text-gray-800">
                            <i class="fab fa-facebook-f text-blue-600 mr-2"></i> Facebook
                        </button>
                        <button onclick="shareCertificate('twitter')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center text-gray-800">
                            <i class="fab fa-twitter text-blue-400 mr-2"></i> Twitter
                        </button>
                        <button onclick="shareCertificate('linkedin')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center text-gray-800">
                            <i class="fab fa-linkedin-in text-blue-700 mr-2"></i> LinkedIn
                        </button>
                        <button onclick="shareCertificate('whatsapp')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center text-gray-800">
                            <i class="fab fa-whatsapp text-green-500 mr-2"></i> WhatsApp
                        </button>
                        <button onclick="copyCertificateLink()" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded flex items-center text-gray-800">
                            <i class="fas fa-link text-gray-600 mr-2"></i> Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer/>


    {{-- Including JS directly below for standalone example --}}
    <script src="{{ asset('assets/js/certificate.js') }}"></script>

</body>
</html>
