<nav class="bg-fine-color shadow-md z-10 fixed w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo and title -->
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h1 class="text-xl font-bold text-accent-dark">EduVerse</h1>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-center space-x-4">
                    <a href="/"
                        class="flex items-center px-3 py-2 text-white hover:bg-accent-light rounded-md transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('courses') }}"
                        class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.09a1 1 0 01.44 1.352l-2.101 4.63A1.518 1.518 0 004.412 16.2l.314-.1a1.036 1.036 0 00.707-.88V9.82a1 1 0 00-.293-.707L3.31 9.09z" />
                        </svg>
                        Courses
                    </a>
                    <a href="{{ route('users') }}"
                        class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M17 10c1.656 0 3-1.344 3-3s-1.344-3-3-3-3 1.344-3 3 1.344 3 3 3zm-10 0c1.656 0 3-1.344 3-3s-1.344-3-3-3-3 1.344-3 3 1.344 3 3 3zm10 2c-2.67 0-8 1.336-8 4v2h16v-2c0-2.664-5.33-4-8-4zm-10 0c-.354 0-.689.031-1 .078-2.243.375-4 1.659-4 3.922v2h6v-2c0-.747.213-1.374.547-1.953-.812-.307-1.791-.547-2.547-.547z" />
                        </svg>
                        Users
                    </a>
                    <a href="{{ route('home') }}"
                        class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M14 3v2h4.586L8.293 15.293l1.414 1.414L20 6.414V11h2V3h-8zM4 5v16h16v-6h2v8H2V5h2z" />
                        </svg>
                        View Site
                    </a>
                </div>
            </div>

            <!-- Mobile menu button and logout -->
            <div class="flex items-center">
                <a href="{{ route('logout') }}"
                    class="flex items-center px-3 py-2 text-red-600 hover:bg-red-100 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L14.586 9H7a1 1 0 110-2h7.586l-1.293-1.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="hidden md:inline">Logout</span>
                </a>
            </div>
        </div>
    </div>
</nav>
