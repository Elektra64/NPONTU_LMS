


//tailwind config
tailwind.config = {
    theme: {
        extend: {
            colors: {
                'primary': '#4A5568',
                'secondary': '#718096',
                'background': '#F7FAFC',
                'accent-light': '#E2E8F0',
                'accent-dark': '#2D3748',
                'fine-color': '#A1DBF1'
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-out',
                'slide-in-left': 'slideInLeft 0.5s ease-out',
                'pulse-slow': 'pulse 2s infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideInLeft: {
                    '0%': { transform: 'translateX(-100%)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' },
                }
            }
        }
    }
}

//other logic for course pages

  // Course Data
  let courses = [
    {
        id: "web-dev-masterclass",
        title: "Web Development Masterclass",
        category: "Web Development",
        difficulty: "Intermediate",
        description: "Learn full-stack web development with modern technologies",
        duration_weeks: 12,
        hours_per_week: 8,
        video_url: "https://example.com/web-dev-intro",
        final_exam: {
            weight: 30,
            passing_score: 70
        },
        modules: [
            {
                title: "HTML & CSS Fundamentals",
                duration_days: 14,
                description: "Learn the building blocks of web development",
                quiz_weight: 20,
                questions: [
                    {
                        text: "What does HTML stand for?",
                        options: ["Hyper Text Markup Language", "Hyperlinks and Text Markup Language", "Home Tool Markup Language"],
                        correct: 0
                    }
                ]
            }
        ],
        enrollments: 245,
        status: "Published",
        lastUpdated: "2 days ago"
    },
    {
        id: "data-science-bootcamp",
        title: "Data Science Bootcamp",
        category: "Data Science",
        difficulty: "Beginner",
        description: "Introduction to data science and machine learning",
        duration_weeks: 10,
        hours_per_week: 6,
        video_url: "https://example.com/data-science-intro",
        final_exam: {
            weight: 25,
            passing_score: 65
        },
        modules: [
            {
                title: "Python for Data Science",
                duration_days: 10,
                description: "Learn Python basics for data analysis",
                quiz_weight: 15,
                questions: [
                    {
                        text: "Which library is used for numerical operations in Python?",
                        options: ["NumPy", "Pandas", "Matplotlib"],
                        correct: 0
                    }
                ]
            }
        ],
        enrollments: 320,
        status: "Published",
        lastUpdated: "1 week ago"
    }
];

// DOM Elements
const courseModal = document.getElementById('courseModal');
const addCourseBtn = document.getElementById('addCourseBtn');
const closeModalBtn = document.getElementById('closeModal');
const cancelCourseBtn = document.getElementById('cancelCourse');
const courseForm = document.getElementById('courseCreationForm');
const courseList = document.getElementById('courseList');
const modulesContainer = document.getElementById('modules-container');
const addModuleBtn = document.getElementById('add-module');
const moduleTemplate = document.getElementById('module-template');
const questionTemplate = document.getElementById('question-template');

// Track if we're editing a course
let editingCourseId = null;

// Modal Functions
function openModal(editMode = false, courseId = null) {
    if (editMode && courseId) {
        editingCourseId = courseId;
        document.querySelector('#courseModal h2').textContent = 'Edit Course';
        document.querySelector('#courseCreationForm button[type="submit"]').textContent = 'Update Course';
        editCourse(courseId);
    } else {
        editingCourseId = null;
        document.querySelector('#courseModal h2').textContent = 'Create New Course';
        document.querySelector('#courseCreationForm button[type="submit"]').textContent = 'Create Course';
    }
    courseModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    courseModal.classList.add('hidden');
    document.body.style.overflow = '';
    courseForm.reset();
    modulesContainer.innerHTML = '';
    editingCourseId = null;
}

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    renderCourseList();

    // Modal event listeners
    addCourseBtn.addEventListener('click', () => openModal());
    closeModalBtn.addEventListener('click', closeModal);
    cancelCourseBtn.addEventListener('click', closeModal);

    // Add module button
    addModuleBtn.addEventListener('click', addModule);

    // Form submission
    courseForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (editingCourseId) {
            updateCourse(editingCourseId);
        } else {
            createNewCourse();
        }
    });

    // Delegated event listeners for dynamic elements
    modulesContainer.addEventListener('click', function(e) {
        // Remove module
        if (e.target.classList.contains('remove-module') || e.target.closest('.remove-module')) {
            e.target.closest('.module-item').remove();
            updateModuleNumbers();
        }
        // Add question
        else if (e.target.classList.contains('add-question') || e.target.closest('.add-question')) {
            const moduleItem = e.target.closest('.module-item');
            addQuestion(moduleItem);
        }
        // Remove question
        else if (e.target.classList.contains('remove-question') || e.target.closest('.remove-question')) {
            const questionItem = e.target.closest('.question-item');
            questionItem.remove();
            updateQuestionNumbers(questionItem.closest('.quiz-questions'));
        }
    });
});

// Add a new module
function addModule() {
    const moduleCount = modulesContainer.querySelectorAll('.module-item').length + 1;
    const moduleClone = moduleTemplate.content.cloneNode(true);

    // Update module number
    moduleClone.querySelector('.module-number').textContent = moduleCount;

    // Add to container
    modulesContainer.appendChild(moduleClone);

    // Add first question to the new module
    const newModule = modulesContainer.lastElementChild;
    addQuestion(newModule);
}

// Add a new question to a module
function addQuestion(moduleItem) {
    const questionsContainer = moduleItem.querySelector('.quiz-questions');
    const questionCount = questionsContainer.querySelectorAll('.question-item').length + 1;
    const questionClone = questionTemplate.content.cloneNode(true);

    // Update question number
    questionClone.querySelector('.question-number').textContent = questionCount;

    // Add to container
    questionsContainer.appendChild(questionClone);
}

// Update module numbers when one is removed
function updateModuleNumbers() {
    const modules = modulesContainer.querySelectorAll('.module-item');
    modules.forEach((module, index) => {
        module.querySelector('.module-number').textContent = index + 1;
    });
}

// Update question numbers when one is removed
function updateQuestionNumbers(questionsContainer) {
    const questions = questionsContainer.querySelectorAll('.question-item');
    questions.forEach((question, index) => {
        question.querySelector('.question-number').textContent = index + 1;
    });
}

// Render Course List
function renderCourseList() {
    courseList.innerHTML = courses.map(course => `
        <div class="grid grid-cols-12 gap-4 p-4 border-b border-gray-200 hover:bg-gray-50 transition-colors">
            <div class="col-span-5 flex items-center">
                <div class="w-16 h-12 ${getCategoryBgClass(course.category)} rounded-md flex items-center justify-center mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ${getCategoryTextClass(course.category)}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-800">${course.title}</h3>
                    <p class="text-sm text-gray-500">${course.difficulty} level</p>
                </div>
            </div>
            <div class="col-span-2 flex items-center">
                <span class="${getCategoryBadgeClasses(course.category)} px-2 py-1 rounded-full text-xs">${course.category}</span>
            </div>
            <div class="col-span-1 flex items-center text-gray-700">${course.enrollments}</div>
            <div class="col-span-1 flex items-center">
                <span class="${getStatusBadgeClasses(course.status)} px-2 py-1 rounded-full text-xs">${course.status}</span>
            </div>
            <div class="col-span-2 flex items-center text-sm text-gray-600">${course.lastUpdated}</div>
            <div class="col-span-1 flex items-center space-x-2">
                <button onclick="openModal(true, '${course.id}')" class="text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </button>
                <button class="text-red-600 hover:text-red-800" onclick="deleteCourse('${course.id}')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    `).join("");
}

// Create a new course
function createNewCourse() {
    const formData = new FormData(courseForm);

    // Basic course info
    const title = formData.get('title');
    const category = formData.get('category');
    const difficulty = formData.get('difficulty');
    const description = formData.get('description');
    const durationWeeks = formData.get('duration_weeks');
    const hoursPerWeek = formData.get('hours_per_week');
    const videoUrl = formData.get('video_url');
    const finalExamWeight = formData.get('final_exam_weight');
    const passingScore = formData.get('passing_score');

    // Collect modules data
    const modules = [];
    const moduleElements = modulesContainer.querySelectorAll('.module-item');

    moduleElements.forEach(moduleEl => {
        const moduleTitle = moduleEl.querySelector('input[name*="title"]').value;
        const durationDays = moduleEl.querySelector('input[name*="duration_days"]').value;
        const moduleDescription = moduleEl.querySelector('textarea[name*="description"]').value;
        const quizWeight = moduleEl.querySelector('input[name*="quiz_weight"]').value;

        // Collect questions for this module
        const questions = [];
        const questionElements = moduleEl.querySelectorAll('.question-item');

        questionElements.forEach(questionEl => {
            const questionText = questionEl.querySelector('input[name*="text"]').value;
            const options = Array.from(questionEl.querySelectorAll('input[name*="options"]')).map(opt => opt.value);
            const correctAnswer = questionEl.querySelector('input[name*="correct"]:checked')?.value || '0';

            questions.push({
                text: questionText,
                options: options.filter(opt => opt), // Remove empty options
                correct: parseInt(correctAnswer)
            });
        });

        modules.push({
            title: moduleTitle,
            duration_days: parseInt(durationDays),
            description: moduleDescription,
            quiz_weight: parseInt(quizWeight),
            questions: questions
        });
    });

    // Create new course object
    const newCourse = {
        id: title.toLowerCase().replace(/\s+/g, '-'),
        title,
        category,
        difficulty,
        description,
        duration_weeks: parseInt(durationWeeks),
        hours_per_week: parseInt(hoursPerWeek),
        video_url: videoUrl,
        final_exam: {
            weight: parseInt(finalExamWeight),
            passing_score: parseInt(passingScore)
        },
        modules,
        enrollments: 0,
        status: "Published",
        lastUpdated: "Just now"
    };

    // Add to courses array
    courses.unshift(newCourse);

    // Refresh the course list
    renderCourseList();

    // Close modal and reset form
    closeModal();

    // Show success message
    alert(`Course "${title}" created successfully with ${modules.length} modules!`);
}

// Update an existing course
function updateCourse(courseId) {
    const formData = new FormData(courseForm);

    // Basic course info
    const title = formData.get('title');
    const category = formData.get('category');
    const difficulty = formData.get('difficulty');
    const description = formData.get('description');
    const durationWeeks = formData.get('duration_weeks');
    const hoursPerWeek = formData.get('hours_per_week');
    const videoUrl = formData.get('video_url');
    const finalExamWeight = formData.get('final_exam_weight');
    const passingScore = formData.get('passing_score');

    // Collect modules data
    const modules = [];
    const moduleElements = modulesContainer.querySelectorAll('.module-item');

    moduleElements.forEach(moduleEl => {
        const moduleTitle = moduleEl.querySelector('input[name*="title"]').value;
        const durationDays = moduleEl.querySelector('input[name*="duration_days"]').value;
        const moduleDescription = moduleEl.querySelector('textarea[name*="description"]').value;
        const quizWeight = moduleEl.querySelector('input[name*="quiz_weight"]').value;

        // Collect questions for this module
        const questions = [];
        const questionElements = moduleEl.querySelectorAll('.question-item');

        questionElements.forEach(questionEl => {
            const questionText = questionEl.querySelector('input[name*="text"]').value;
            const options = Array.from(questionEl.querySelectorAll('input[name*="options"]')).map(opt => opt.value);
            const correctAnswer = questionEl.querySelector('input[name*="correct"]:checked')?.value || '0';

            questions.push({
                text: questionText,
                options: options.filter(opt => opt), // Remove empty options
                correct: parseInt(correctAnswer)
            });
        });

        modules.push({
            title: moduleTitle,
            duration_days: parseInt(durationDays),
            description: moduleDescription,
            quiz_weight: parseInt(quizWeight),
            questions: questions
        });
    });

    // Find the course index
    const courseIndex = courses.findIndex(course => course.id === courseId);

    if (courseIndex !== -1) {
        // Update course object
        courses[courseIndex] = {
            ...courses[courseIndex],
            title,
            category,
            difficulty,
            description,
            duration_weeks: parseInt(durationWeeks),
            hours_per_week: parseInt(hoursPerWeek),
            video_url: videoUrl,
            final_exam: {
                weight: parseInt(finalExamWeight),
                passing_score: parseInt(passingScore)
            },
            modules,
            lastUpdated: "Just now"
        };

        // Refresh the course list
        renderCourseList();

        // Close modal and reset form
        closeModal();

        // Show success message
        alert(`Course "${title}" updated successfully!`);
    }
}

// Delete Course Function
function deleteCourse(courseId) {
    if (confirm('Are you sure you want to delete this course?')) {
        courses = courses.filter(course => course.id !== courseId);
        renderCourseList();
        alert('Course deleted successfully!');
    }
}

// Edit Course Function
function editCourse(courseId) {
    const course = courses.find(course => course.id === courseId);
    if (!course) {
        console.error('Course not found');
        return;
    }

    const { title, category, difficulty, description, duration_weeks, hours_per_week, video_url, final_exam, modules } = course;

    // Populate form with course data
    document.querySelector('input[name="title"]').value = title;
    document.querySelector('select[name="category"]').value = category;
    document.querySelector('select[name="difficulty"]').value = difficulty;
    document.querySelector('textarea[name="description"]').value = description;
    document.querySelector('input[name="duration_weeks"]').value = duration_weeks;
    document.querySelector('input[name="hours_per_week"]').value = hours_per_week;
    document.querySelector('input[name="video_url"]').value = video_url;
    document.querySelector('input[name="final_exam_weight"]').value = final_exam.weight;
    document.querySelector('input[name="passing_score"]').value = final_exam.passing_score;

    // Clear existing modules
    modulesContainer.innerHTML = '';

    // Add modules and questions
    modules.forEach((module, moduleIndex) => {
        addModule();
        const moduleItem = modulesContainer.lastElementChild;

        // Fill module data
        moduleItem.querySelector('input[name*="title"]').value = module.title;
        moduleItem.querySelector('input[name*="duration_days"]').value = module.duration_days;
        moduleItem.querySelector('textarea[name*="description"]').value = module.description;
        moduleItem.querySelector('input[name*="quiz_weight"]').value = module.quiz_weight;

        // Clear any default questions
        const questionsContainer = moduleItem.querySelector('.quiz-questions');
        questionsContainer.innerHTML = '';

        // Add questions
        if (module.questions && module.questions.length > 0) {
            module.questions.forEach((question, questionIndex) => {
                addQuestion(moduleItem);
                const questionItem = questionsContainer.lastElementChild;

                // Fill question data
                questionItem.querySelector('input[name*="text"]').value = question.text;

                // Fill options
                const optionInputs = questionItem.querySelectorAll('input[name*="options"]');
                question.options.forEach((option, i) => {
                    if (optionInputs[i]) {
                        optionInputs[i].value = option;
                    }
                });

                // Set correct answer
                if (question.correct >= 0 && question.correct < optionInputs.length) {
                    const correctInput = questionItem.querySelector(`input[name*="correct"][value="${question.correct}"]`);
                    if (correctInput) {
                        correctInput.checked = true;
                    }
                }
            });
        }
    });
}

// Helper functions for styling
function getCategoryBadgeClasses(category) {
    const categoryClasses = {
        'Web Development': 'bg-green-100 text-green-800',
        'Data Science': 'bg-purple-100 text-purple-800',
        'Design': 'bg-blue-100 text-blue-800',
        'Business': 'bg-yellow-100 text-yellow-800'
    };
    return categoryClasses[category] || 'bg-gray-100 text-gray-800';
}

function getCategoryBgClass(category) {
    const categoryClasses = {
        'Web Development': 'bg-green-50',
        'Data Science': 'bg-purple-50',
        'Design': 'bg-blue-50',
        'Business': 'bg-yellow-50'
    };
    return categoryClasses[category] || 'bg-gray-50';
}

function getCategoryTextClass(category) {
    const categoryClasses = {
        'Web Development': 'text-green-600',
        'Data Science': 'text-purple-600',
        'Design': 'text-blue-600',
        'Business': 'text-yellow-600'
    };
    return categoryClasses[category] || 'text-gray-600';
}

function getStatusBadgeClasses(status) {
    const statusClasses = {
        'Published': 'bg-blue-100 text-blue-800',
        'Draft': 'bg-yellow-100 text-yellow-800',
        'Archived': 'bg-gray-100 text-gray-800'
    };
    return statusClasses[status] || 'bg-gray-100 text-gray-800';
}
