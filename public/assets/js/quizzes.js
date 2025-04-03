


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




// Shared Data Store (could be moved to a separate file if used in multiple places)
let courses = [];
let quizzes = [];

// DOM Elements
const quizList = document.getElementById('quizList');
const courseFilter = document.getElementById('courseFilter');
const quizTypeFilter = document.getElementById('quizTypeFilter');
const applyFilters = document.getElementById('applyFilters');
const quizPreviewModal = document.getElementById('quizPreviewModal');
const quizAttemptModal = document.getElementById('quizAttemptModal');

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    // Load courses and quizzes from localStorage or API
    loadCoursesAndQuizzes();

    // Set up event listeners
    applyFilters.addEventListener('click', applyQuizFilters);
    document.getElementById('closePreviewModal').addEventListener('click', closePreviewModal);
    document.getElementById('closeAttemptModal').addEventListener('click', closeAttemptModal);
    document.getElementById('quizAttemptForm').addEventListener('submit', submitQuiz);
});

// Load courses and quizzes
function loadCoursesAndQuizzes() {
    // In a real app, you would fetch this from an API
    // For now, we'll use localStorage or mock data
    const savedCourses = localStorage.getItem('eduverse-courses');
    courses = savedCourses ? JSON.parse(savedCourses) : [];


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// WILL REPLACE THE LocalStorage WITH API PATH TO OUR DATABASE

// async function loadCoursesAndQuizzes() {
//     try {
//         // Fetch courses from your API
//         const coursesResponse = await fetch('/api/courses');
//         courses = await coursesResponse.json();

//         // Fetch quizzes from your API
//         const quizzesResponse = await fetch('/api/quizzes');
//         quizzes = await quizzesResponse.json();

//         populateCourseFilter();
//         renderQuizList();
//     } catch (error) {
//         console.error('Failed to load data:', error);
//         // Show error message to user
//     }
// }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    // Extract quizzes from courses
    extractQuizzesFromCourses();

    // Populate course filter dropdown
    populateCourseFilter();

    // Render quiz list
    renderQuizList();
}

// Extract quizzes from courses data
function extractQuizzesFromCourses() {
    quizzes = [];

    courses.forEach(course => {
        // Add module quizzes
        if (course.modules && course.modules.length > 0) {
            course.modules.forEach(module => {
                if (module.questions && module.questions.length > 0) {
                    quizzes.push({
                        id: `module-${module.title.toLowerCase().replace(/\s+/g, '-')}-${course.id}`,
                        title: `${module.title} Quiz`,
                        courseId: course.id,
                        courseTitle: course.title,
                        type: 'module',
                        questions: module.questions,
                        weight: module.quiz_weight,
                        duration: module.duration_days * 30 // 30 minutes per day of module
                    });
                }
            });
        }

        // Add final exam
        if (course.final_exam && course.final_exam.questions) {
            quizzes.push({
                id: `final-${course.id}`,
                title: `${course.title} Final Exam`,
                courseId: course.id,
                courseTitle: course.title,
                type: 'final',
                questions: course.final_exam.questions,
                weight: course.final_exam.weight,
                duration: 60 // 60 minutes for final exam
            });
        }
    });

    // Save to localStorage for persistence
    localStorage.setItem('eduverse-quizzes', JSON.stringify(quizzes));
}

// Populate course filter dropdown
function populateCourseFilter() {
    courseFilter.innerHTML = '<option value="">All Courses</option>';

    courses.forEach(course => {
        const option = document.createElement('option');
        option.value = course.id;
        option.textContent = course.title;
        courseFilter.appendChild(option);
    });
}

// Apply filters to quiz list
function applyQuizFilters() {
    const selectedCourse = courseFilter.value;
    const selectedType = quizTypeFilter.value;

    const filteredQuizzes = quizzes.filter(quiz => {
        const courseMatch = !selectedCourse || quiz.courseId === selectedCourse;
        const typeMatch = !selectedType || quiz.type === selectedType;
        return courseMatch && typeMatch;
    });

    renderQuizList(filteredQuizzes);
}

// Render quiz list
function renderQuizList(quizzesToRender = quizzes) {
    document.getElementById('totalQuizzes').textContent = quizzesToRender.length;

    quizList.innerHTML = quizzesToRender.map(quiz => `
        <div class="grid grid-cols-12 gap-4 p-4 border-b border-gray-200 hover:bg-gray-50 transition-colors">
            <div class="col-span-4 flex items-center">
                <div class="w-12 h-12 ${getQuizBgClass(quiz.type)} rounded-md flex items-center justify-center mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ${getQuizTextClass(quiz.type)}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-800">${quiz.title}</h3>
                    <p class="text-sm text-gray-500">${quiz.questions.length} questions</p>
                </div>
            </div>
            <div class="col-span-3 flex items-center text-gray-700">${quiz.courseTitle}</div>
            <div class="col-span-2 flex items-center">
                <span class="${getQuizTypeBadgeClasses(quiz.type)} px-2 py-1 rounded-full text-xs">
                    ${quiz.type === 'module' ? 'Module Quiz' : 'Final Exam'}
                </span>
            </div>
            <div class="col-span-2 flex items-center text-gray-700">${quiz.questions.length}</div>
            <div class="col-span-1 flex items-center space-x-2">
                <button onclick="previewQuiz('${quiz.id}')" class="text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                <button onclick="attemptQuiz('${quiz.id}')" class="text-green-600 hover:text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    `).join("");
}

// Preview quiz
function previewQuiz(quizId) {
    const quiz = quizzes.find(q => q.id === quizId);
    if (!quiz) return;

    document.getElementById('quizPreviewTitle').textContent = quiz.title;
    const previewContent = document.getElementById('quizPreviewContent');

    previewContent.innerHTML = `
        <div class="mb-6">
            <h3 class="text-lg font-medium text-accent-dark mb-2">Quiz Details</h3>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-600">Course:</p>
                    <p class="font-medium">${quiz.courseTitle}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Type:</p>
                    <p class="font-medium">${quiz.type === 'module' ? 'Module Quiz' : 'Final Exam'}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Weight:</p>
                    <p class="font-medium">${quiz.weight}%</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Duration:</p>
                    <p class="font-medium">${quiz.duration} minutes</p>
                </div>
            </div>
        </div>
        <div>
            <h3 class="text-lg font-medium text-accent-dark mb-4">Questions (${quiz.questions.length})</h3>
            <div class="space-y-6">
                ${quiz.questions.map((question, index) => `
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <p class="font-medium mb-3">Question ${index + 1}: ${question.text}</p>
                        <div class="space-y-2">
                            ${question.options.map((option, optIndex) => `
                                <div class="flex items-center">
                                    <div class="w-5 h-5 rounded-full border border-gray-300 mr-2 flex items-center justify-center ${optIndex === question.correct ? 'bg-green-100 border-green-500' : ''}">
                                        ${optIndex === question.correct ? '✓' : ''}
                                    </div>
                                    <span class="${optIndex === question.correct ? 'font-medium text-green-700' : 'text-gray-700'}">${option}</span>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>
    `;

    quizPreviewModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Attempt quiz
function attemptQuiz(quizId) {
    const quiz = quizzes.find(q => q.id === quizId);
    if (!quiz) return;

    document.getElementById('quizAttemptTitle').textContent = quiz.title;
    const questionsContainer = document.getElementById('quizQuestionsContainer');

    // Start timer
    startQuizTimer(quiz.duration);

    // Render questions
    questionsContainer.innerHTML = quiz.questions.map((question, index) => `
        <div class="mb-8">
            <p class="font-medium mb-4">Question ${index + 1}: ${question.text}</p>
            <div class="space-y-3">
                ${question.options.map((option, optIndex) => `
                    <div class="flex items-center">
                        <input type="radio" id="q${index}-opt${optIndex}" name="q${index}" value="${optIndex}" class="h-4 w-4 text-primary focus:ring-primary">
                        <label for="q${index}-opt${optIndex}" class="ml-2 text-gray-700">${option}</label>
                    </div>
                `).join('')}
            </div>
        </div>
    `).join('');

    quizAttemptModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Start quiz timer
function startQuizTimer(minutes) {
    let time = minutes * 60;
    const timerElement = document.getElementById('quizTimer');

    const timer = setInterval(() => {
        if (time <= 0) {
            clearInterval(timer);
            submitQuiz();
            return;
        }

        const mins = Math.floor(time / 60);
        const secs = time % 60;
        timerElement.textContent = `Time: ${mins}:${secs < 10 ? '0' : ''}${secs}`;
        time--;

        // Change color when time is running out
        if (time < 300) { // 5 minutes left
            timerElement.classList.remove('bg-blue-100', 'text-blue-800');
            timerElement.classList.add('bg-red-100', 'text-red-800');
        }
    }, 1000);

    // Store timer so we can clear it if needed
    quizAttemptModal.dataset.timer = timer;
}

// Submit quiz
function submitQuiz(e) {
    if (e) e.preventDefault();

    // Clear timer
    clearInterval(quizAttemptModal.dataset.timer);

    // Calculate score
    const quizId = document.getElementById('quizAttemptTitle').textContent
        .replace('Take Quiz: ', '');
    const quiz = quizzes.find(q => q.title === quizId);

    if (!quiz) {
        closeAttemptModal();
        return;
    }

    const formData = new FormData(document.getElementById('quizAttemptForm'));
    let correctAnswers = 0;

    quiz.questions.forEach((question, index) => {
        const selectedOption = formData.get(`q${index}`);
        if (selectedOption && parseInt(selectedOption) === question.correct) {
            correctAnswers++;
        }
    });

    const score = Math.round((correctAnswers / quiz.questions.length) * 100);
    const passed = score >= (quiz.type === 'final' ? quiz.passing_score || 70 : 60);

    // Show results
    const questionsContainer = document.getElementById('quizQuestionsContainer');
    questionsContainer.innerHTML = `
        <div class="text-center mb-8">
            <h3 class="text-2xl font-bold ${passed ? 'text-green-600' : 'text-red-600'} mb-2">
                ${passed ? 'Quiz Passed!' : 'Quiz Failed'}
            </h3>
            <p class="text-lg">Your score: <span class="font-bold">${score}%</span></p>
            <p class="text-gray-600">${correctAnswers} out of ${quiz.questions.length} questions correct</p>
        </div>
        <div class="space-y-6">
            ${quiz.questions.map((question, index) => {
                const selectedOption = formData.get(`q${index}`);
                const isCorrect = selectedOption && parseInt(selectedOption) === question.correct;

                return `
                    <div class="p-4 border rounded-lg ${isCorrect ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50'}">
                        <p class="font-medium mb-3">Question ${index + 1}: ${question.text}</p>
                        <div class="space-y-2">
                            ${question.options.map((option, optIndex) => {
                                let optionClass = '';
                                if (optIndex === question.correct) {
                                    optionClass = 'text-green-700 font-medium';
                                } else if (selectedOption && parseInt(selectedOption) === optIndex && !isCorrect) {
                                    optionClass = 'text-red-700 font-medium';
                                }

                                return `
                                    <div class="flex items-center">
                                        <div class="w-5 h-5 rounded-full border mr-2 flex items-center justify-center
                                            ${optIndex === question.correct ? 'border-green-500 bg-green-100' :
                                              (selectedOption && parseInt(selectedOption) === optIndex && !isCorrect ? 'border-red-500 bg-red-100' : 'border-gray-300')}">
                                            ${optIndex === question.correct ? '✓' :
                                             (selectedOption && parseInt(selectedOption) === optIndex && !isCorrect ? '✗' : '')}
                                        </div>
                                        <span class="${optionClass}">${option}</span>
                                    </div>
                                `;
                            }).join('')}
                        </div>
                    </div>
                `;
            }).join('')}
        </div>
    `;
}

// Close modals
function closePreviewModal() {
    quizPreviewModal.classList.add('hidden');
    document.body.style.overflow = '';
}

function closeAttemptModal() {
    clearInterval(quizAttemptModal.dataset.timer);
    quizAttemptModal.classList.add('hidden');
    document.body.style.overflow = '';
    document.getElementById('quizAttemptForm').reset();
}

// Helper functions for styling
function getQuizTypeBadgeClasses(type) {
    return type === 'module' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800';
}

function getQuizBgClass(type) {
    return type === 'module' ? 'bg-blue-50' : 'bg-purple-50';
}

function getQuizTextClass(type) {
    return type === 'module' ? 'text-blue-600' : 'text-purple-600';
}


///// .........Will BE NEEDED....../////////*css*/`
// async function submitQuiz(e) {
//     if (e) e.preventDefault();

//     const quizId = /* get quiz ID */;
//     const answers = /* collect user answers */;

//     try {
//         const response = await fetch('/api/quiz-attempts', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//             },
//             body: JSON.stringify({
//                 quiz_id: quizId,
//                 answers: answers
//             })
//         });

//         const result = await response.json();

//         // Show results to user
//         displayQuizResults(result);

//     } catch (error) {
//         console.error('Failed to submit quiz:', error);
//         // Show error message to user
//     }
// }

