document.addEventListener('DOMContentLoaded', function() {
    // Get the data from HTML attribute
    const courseDataElement = document.getElementById("courseData");
    const courses = JSON.parse(courseDataElement.dataset.courses);

    // Get DOM elements
    const searchInput = document.getElementById("searchInput");
    const categoryFilter = document.getElementById("categoryFilter");
    const difficultyFilter = document.getElementById("difficultyFilter");
    const courseGrid = document.getElementById("courseGrid");

    // function filterCourses() {
    //     const searchTerm = searchInput.value.toLowerCase();
    //     const category = categoryFilter.value;
    //     const difficulty = difficultyFilter.value;

    //     courseGrid.innerHTML = `
    //         <div class="col-span-3 text-center py-12">
    //             <i class="fas fa-spinner fa-spin text-3xl text-yellow-500 mb-4"></i>
    //             <p class="text-gray-600">Loading courses...</p>
    //         </div>
    //     `;

    //     setTimeout(() => {
    //         const filteredCourses = courses.filter(course => {
    //             const matchesSearch = course.title.toLowerCase().includes(searchTerm) ||
    //                                  course.description.toLowerCase().includes(searchTerm);
    //             const matchesCategory = !category || course.category.toLowerCase() === category.toLowerCase();
    //             const matchesDifficulty = !difficulty || course.difficulty === difficulty.toLowerCase();

    //             return matchesSearch && matchesCategory && matchesDifficulty;
    //         });

    //         if (filteredCourses.length > 0) {
    //             renderCourses(filteredCourses);
    //         } else {
    //             courseGrid.innerHTML = `
    //                 <div class="col-span-3 text-center py-12">
    //                     <i class="fas fa-book-open text-3xl text-gray-400 mb-4"></i>
    //                     <h3 class="text-xl font-bold text-gray-700 mb-2">No courses found</h3>
    //                     <p class="text-gray-500">Try adjusting your search or filter criteria</p>
    //                 </div>
    //             `;
    //         }
    //     }, 800);
    // }

    // Event listeners
    // searchInput.addEventListener('input', filterCourses);
    // categoryFilter.addEventListener('change', filterCourses);
    // difficultyFilter.addEventListener('change', filterCourses);
});
