document.addEventListener('DOMContentLoaded', function() {
    // Get the data from HTML attribute
    const courseDataElement = document.getElementById('courseData');
    const courses = JSON.parse(courseDataElement.dataset.courses);

    // Get DOM elements
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const difficultyFilter = document.getElementById('difficultyFilter');
    const courseGrid = document.getElementById('courseGrid');

    // Debug: Check if data loaded
    console.log('Courses data:', courses);
    if (!courses || courses.length === 0) {
        courseGrid.innerHTML = `
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-book-open text-3xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-700 mb-2">No courses available</h3>
                <p class="text-gray-500">Check back later for new courses</p>
            </div>
        `;
        return;
    }

    function renderCourses(coursesToRender) {
        courseGrid.innerHTML = '';

        coursesToRender.forEach(course => {
            // Create card element
            const courseCard = document.createElement('div');
            courseCard.className = 'bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-lg course-card transition duration-300';

            // Generate enroll URL
            const enrollUrl = `/enroll/${course.id}/verify`;

          // In your publishedCourse.js file, update the courseCard.innerHTML section:
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
            <span>${course.students_count.toLocaleString()} students</span>
        </div>
        <a href="/courses/${course.id}/preview" class="text-yellow-400 hover:text-yellow-300 text-sm font-semibold">
            Preview Course <i class="fas fa-eye ml-1"></i>
        </a>
    </div>
</div>
`;

            courseGrid.appendChild(courseCard);
        });
    }

    // Rest of your code remains the same...
    renderCourses(courses);

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
                const matchesCategory = !category || course.category.toLowerCase() === category.toLowerCase();
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


    // Event listeners
    searchInput.addEventListener('input', filterCourses);
    categoryFilter.addEventListener('change', filterCourses);
    difficultyFilter.addEventListener('change', filterCourses);
});
