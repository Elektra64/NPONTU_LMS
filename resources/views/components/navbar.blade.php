<nav class="bg-gray-900 text-white p-4 flex justify-between items-center sticky top-0 z-50 shadow-lg">
    <div class="flex items-center space-x-8">
        <span class="text-2xl font-bold text-yellow-400 flex items-center">
            <a href="/home" class="cursor-pointer">
                <i class="fas fa-graduation-cap mr-2"></i>EduVerse
            </a>
        </span>
        <div class="hidden md:flex space-x-6">
            <!-- Unified Courses Entry -->
            <a href="{{ route('courses.publishedCourse') }}" class="hover:text-yellow-400 transition duration-300 flex items-center">
                <i class="fas fa-book-open mr-2"></i>Courses
            </a>

            <!-- Learning Tools -->
            <a href="{{ route('quizzes') }}" class="hover:text-yellow-400 transition duration-300 flex items-center">
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
                <a href="{{ route('courses.publishedCourse') }}" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-search mr-2"></i> Browse Catalog
                </a>

                <a href="{{ route('certificateTemplate') }}" class="block px-4 py-2 hover:bg-gray-700">
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
