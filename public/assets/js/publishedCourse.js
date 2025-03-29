document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const difficultyFilter = document.getElementById('difficultyFilter');
    const courseGrid = document.getElementById('courseGrid');

    const courses = [
        {
            id: 1,
            title: "Complete Web Developer Bootcamp 2023",
            category: "Web Development",
            description: "Master HTML, CSS, JavaScript, React, Node.js and more with this comprehensive course.",
            image: "https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
            rating: 4.9,
            students: 12345,
            difficulty: "beginner",
            badge: "BESTSELLER",
            badgeColor: "bg-yellow-500 text-black"
        },
        {
            id: 2,
            title: "Data Science & Machine Learning",
            category: "Data Science",
            description: "Learn Python, Pandas, NumPy, Matplotlib, Scikit-learn, TensorFlow and more.",
            image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
            rating: 4.8,
            students: 8765,
            difficulty: "intermediate",
            badge: "NEW",
            badgeColor: "bg-blue-500 text-white"
        },
        {
            id: 3,
            title: "Digital Marketing Masterclass",
            category: "Marketing",
            description: "SEO, Social Media, PPC, Email Marketing, Content Marketing, Analytics & More!",
            image: "https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
            rating: 4.7,
            students: 6543,
            difficulty: "beginner"
        },
        {
            id: 4,
            title: "Business Fundamentals",
            category: "Business",
            description: "Learn the core concepts of business including finance, marketing, operations, and strategy.",
            image: "https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
            rating: 4.8,
            students: 9876,
            difficulty: "beginner",
            badge: "BESTSELLER",
            badgeColor: "bg-yellow-500 text-black"
        },
        {
            id: 5,
            title: "UI/UX Design Specialization",
            category: "Design",
            description: "Master user interface and user experience design principles. Learn Figma, Adobe XD.",
            image: "https://images.unsplash.com/photo-1626785774573-4b799315345d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
            rating: 4.6,
            students: 5432,
            difficulty: "intermediate"
        },
        {
            id: 6,
            title: "Flutter Mobile App Development",
            category: "Mobile Development",
            description: "Build cross-platform mobile apps with Flutter and Dart. Publish to App Stores.",
            image: "https://images.unsplash.com/photo-1610563166150-b34df4f3bcd6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
            rating: 4.5,
            students: 7654,
            difficulty: "advanced",
            badge: "FREE",
            badgeColor: "bg-green-500 text-white"
        }
    ];

    function renderCourses(coursesToRender) {
        courseGrid.innerHTML = '';

        coursesToRender.forEach(course => {
            const courseCard = document.createElement('div');
            courseCard.className = 'bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-lg course-card transition duration-300';

            courseCard.innerHTML = `
                <div class="relative">
                    <img src="${course.image}" alt="${course.title}" class="w-full h-48 object-cover">
                    ${course.badge ? `<div class="absolute top-2 right-2 ${course.badgeColor} text-xs font-bold px-2 py-1 rounded">${course.badge}</div>` : ''}
                    <span class="difficulty-${course.difficulty} text-xs font-bold px-2 py-1 rounded absolute top-2 left-2">
                        ${course.difficulty.charAt(0).toUpperCase() + course.difficulty.slice(1)}
                    </span>
                </div>
                <div class="p-6 bg-blue-400">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-yellow-400 text-sm font-semibold">${course.category}</span>
                        <div class="flex items-center text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="ml-1 text-white">${course.rating}</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">${course.title}</h3>
                    <p class="text-white text-sm mb-4">${course.description}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-sm text-white">
                            <i class="fas fa-user-graduate mr-1"></i>
                            <span>${course.students.toLocaleString()} students</span>
                        </div>
                        <a href="/enroll/{{ $course->id }}"  class="text-yellow-400 hover:text-yellow-300 text-sm font-semibold">
                            Enroll Now <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            `;

            courseGrid.appendChild(courseCard);
        });
    }

    function filterCourses() {
        const searchTerm = searchInput.value.toLowerCase();
        const category = categoryFilter.value;
        const difficulty = difficultyFilter.value;

        courseGrid.innerHTML = `
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-spinner fa-spin text-3xl text-yellow-500 mb-4"></i>
                <p class="text-gray-600">Loading courses...</p>
            </div>
        `;

        setTimeout(() => {
            const filteredCourses = courses.filter(course => {
                const matchesSearch = course.title.toLowerCase().includes(searchTerm) ||
                                     course.description.toLowerCase().includes(searchTerm);
                const matchesCategory = !category || course.category.toLowerCase().includes(category.toLowerCase());
                const matchesDifficulty = !difficulty || course.difficulty === difficulty.toLowerCase();

                return matchesSearch && matchesCategory && matchesDifficulty;
            });

            if (filteredCourses.length > 0) {
                renderCourses(filteredCourses);
            } else {
                courseGrid.innerHTML = `
                    <div class="col-span-3 text-center py-12">
                        <i class="fas fa-book-open text-3xl text-gray-400 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">No courses found</h3>
                        <p class="text-gray-500">Try adjusting your search or filter criteria</p>
                    </div>
                `;
            }
        }, 800);
    }

    // Initial render
    renderCourses(courses);

    // Event listeners
    searchInput.addEventListener('input', filterCourses);
    categoryFilter.addEventListener('change', filterCourses);
    difficultyFilter.addEventListener('change', filterCourses);
});
