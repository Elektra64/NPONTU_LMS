class CourseProgress {
    constructor(courseId, currentSection, currentLesson, totalLessons, hasFinalQuiz, passingScore, courseContent) {
        this.courseId = courseId;
        this.currentSection = currentSection;
        this.currentLesson = currentLesson;
        this.totalLessons = totalLessons;
        this.hasFinalQuiz = hasFinalQuiz;
        this.passingScore = passingScore;
        this.courseContent = courseContent; // Store the full course content
        this.storageKey = `course_${courseId}_progress`;
        this.quizStorageKey = `course_${courseId}_quiz_results`;
        this.completedLessons = this.loadProgress();
        this.completedQuizzes = this.loadQuizResults();

        this.initialize();
    }

    loadProgress() {
        const progress = localStorage.getItem(this.storageKey);
        return progress ? JSON.parse(progress) : [];
    }

    loadQuizResults() {
        const results = localStorage.getItem(this.quizStorageKey);
        return results ? JSON.parse(results) : {};
    }

    saveProgressToStorage() {
        localStorage.setItem(this.storageKey, JSON.stringify(this.completedLessons));
    }

    saveQuizResultsToStorage() {
        localStorage.setItem(this.quizStorageKey, JSON.stringify(this.completedQuizzes));
    }

    getProgressPercentage() {
        return this.totalLessons > 0 ? Math.round((this.completedLessons.length / this.totalLessons) * 100) : 0;
    }

    isLessonCompleted(sectionIndex, lessonIndex) {
        return this.completedLessons.some(lesson =>
            lesson.sectionIndex === sectionIndex && lesson.lessonIndex === lessonIndex
        );
    }

    isQuizPassed(quizId) {
        const quizResult = this.completedQuizzes[quizId];
        return quizResult && quizResult.passed;
    }

    toggleLessonCompletion(sectionIndex, lessonIndex) {
        const index = this.completedLessons.findIndex(lesson =>
            lesson.sectionIndex === sectionIndex && lesson.lessonIndex === lessonIndex
        );

        if (index === -1) {
            this.completedLessons.push({ sectionIndex, lessonIndex });
        } else {
            this.completedLessons.splice(index, 1);
        }

        this.saveProgressToStorage();
        return index === -1;
    }

    // Simplified requirement check - just check progress percentage and final quiz if applicable
    checkAllRequirementsMet() {
        console.group("Checking course completion requirements (simplified)");

        // Check if progress is at least 80%
        const progressPercent = this.getProgressPercentage();
        console.log(`Progress percentage: ${progressPercent}%`);

        if (progressPercent < 80) {
            console.log("Progress below 80% - requirements not met");
            console.groupEnd();
            return false;
        }

        // If course has final quiz, check if it's passed
        if (this.hasFinalQuiz) {
            const finalQuizPassed = this.isQuizPassed('final-quiz-container');
            console.log("Final quiz passed:", finalQuizPassed);

            if (!finalQuizPassed) {
                console.log("Final quiz not passed - requirements not met");
                console.groupEnd();
                return false;
            }
        }

        console.log("All requirements met!");
        console.groupEnd();
        return true;
    }

    updateProgressDisplay() {
        const progressPercent = this.getProgressPercentage();
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-percent');

        if (progressBar) progressBar.style.width = `${progressPercent}%`;
        if (progressText) progressText.textContent = `${progressPercent}%`;

        document.querySelectorAll('.lesson-item').forEach(item => {
            const sectionIndex = parseInt(item.dataset.sectionIndex);
            const lessonIndex = parseInt(item.dataset.lessonIndex);

            if (this.isLessonCompleted(sectionIndex, lessonIndex)) {
                item.classList.add('completed');
                const icon = item.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-circle', 'fa-play-circle', 'text-gray-400', 'text-yellow-500');
                    icon.classList.add('fa-check-circle', 'text-green-500');
                }
            }
        });

        // Update course completion button state
        this.updateCourseCompletionButton();
    }

    updateCompleteButton() {
        const markCompleteBtn = document.getElementById('mark-complete-btn');
        if (!markCompleteBtn) return;

        const isCompleted = this.isLessonCompleted(this.currentSection, this.currentLesson);

        if (isCompleted) {
            markCompleteBtn.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Completed';
            markCompleteBtn.classList.remove('bg-green-500', 'hover:bg-green-600');
            markCompleteBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
            markCompleteBtn.disabled = true;
        } else {
            markCompleteBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Mark as Complete';
            markCompleteBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
            markCompleteBtn.classList.add('bg-green-500', 'hover:bg-green-600');
            markCompleteBtn.disabled = false;
        }
    }

    updateCourseCompletionButton() {
        const completeCourseBtn = document.getElementById('complete-course-btn');
        if (!completeCourseBtn) return;

        const allRequirementsMet = this.checkAllRequirementsMet();

        if (allRequirementsMet) {
            this.enableCompleteCourseButton();
        } else {
            completeCourseBtn.disabled = true;
            completeCourseBtn.classList.remove('bg-green-500', 'hover:bg-green-600');
            completeCourseBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
        }
    }

    saveProgress() {
        const saveProgressBtn = document.getElementById('save-progress-btn');
        if (!saveProgressBtn) return;

        const originalText = saveProgressBtn.innerHTML;
        saveProgressBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
        saveProgressBtn.disabled = true;

        setTimeout(() => {
            this.saveProgressToStorage();
            this.saveQuizResultsToStorage();
            this.updateProgressDisplay();

            saveProgressBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Progress Saved';
            setTimeout(() => {
                saveProgressBtn.innerHTML = originalText;
                saveProgressBtn.disabled = false;
            }, 2000);
        }, 800);
    }

    initializeQuiz(quizContainerId) {
        const quizContainer = document.getElementById(quizContainerId);
        if (!quizContainer) return;

        const quizForm = quizContainer.querySelector('form');
        const quizSubmitBtn = quizContainer.querySelector('#quiz-submit-btn');
        const quizResults = quizContainer.querySelector('#quiz-results');
        const quizRetryBtn = quizContainer.querySelector('#quiz-retry-btn');
        const quizContinueBtn = quizContainer.querySelector('#quiz-continue-btn');
        const quizProgressBar = quizContainer.querySelector('#quiz-progress-bar');
        const quizQuestions = quizContainer.querySelectorAll('.quiz-question');

        let quizSubmitted = false;
        let score = 0;
        const totalQuestions = quizQuestions.length;

        // Update quiz progress bar
        function updateQuizProgress() {
            const answeredQuestions = quizContainer.querySelectorAll('input[type="radio"]:checked').length;
            const progressPercent = (answeredQuestions / totalQuestions) * 100;
            quizProgressBar.style.width = `${progressPercent}%`;
        }

        // Handle quiz option selection
        quizContainer.querySelectorAll('.quiz-option').forEach(option => {
            option.addEventListener('click', function() {
                if (quizSubmitted) return;

                const questionDiv = this.closest('.quiz-question');
                questionDiv.querySelectorAll('.quiz-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;

                updateQuizProgress();
            });
        });

        // Handle quiz submission
        quizForm.addEventListener('submit', (e) => {
            e.preventDefault();
            if (quizSubmitted) return;

            // Calculate score
            score = 0;
            quizQuestions.forEach(question => {
                const selectedOption = question.querySelector('.quiz-option.selected');
                const feedback = question.querySelector('.quiz-feedback');
                const correctAnswer = feedback.dataset.correct;

                if (selectedOption) {
                    const selectedValue = selectedOption.querySelector('input').value;

                    if (selectedValue === correctAnswer) {
                        score++;
                        selectedOption.classList.add('correct');
                        feedback.classList.add('correct');
                    } else {
                        selectedOption.classList.add('incorrect');
                        question.querySelector(`.quiz-option input[value="${correctAnswer}"]`).parentElement.classList.add('correct');
                        feedback.classList.add('incorrect');
                    }
                }
            });

            // Calculate percentage and check if passed
            const percentage = Math.round((score / totalQuestions) * 100);
            const passed = percentage >= this.passingScore;

            // Store quiz result
            this.completedQuizzes[quizContainerId] = {
                passed: passed,
                score: score,
                totalQuestions: totalQuestions,
                percentage: percentage,
                timestamp: new Date().toISOString()
            };
            this.saveQuizResultsToStorage();

            // Display results
            quizResults.style.display = 'block';
            quizResults.className = `quiz-results ${passed ? 'passed' : 'failed'}`;
            quizResults.querySelector('h3').textContent = passed ? 'Quiz Passed!' : 'Quiz Failed';
            quizResults.querySelector('p').textContent =
                `You scored ${score} out of ${totalQuestions} (${percentage}%). ` +
                (passed ? 'Congratulations!' : `You need at least ${this.passingScore}% to pass.`);

            // Show appropriate buttons
            if (passed) {
                quizContinueBtn.classList.remove('hidden');
                if (quizContainerId === 'final-quiz-container') {
                    this.enableCompleteCourseButton();
                }
            } else {
                quizRetryBtn.classList.remove('hidden');
            }

            quizSubmitBtn.textContent = 'Try Again';
            quizSubmitted = true;

            // Update course completion button state
            this.updateCourseCompletionButton();
        });

        // Handle quiz retry
        if (quizRetryBtn) {
            quizRetryBtn.addEventListener('click', () => {
                quizContainer.querySelectorAll('.quiz-option').forEach(option => {
                    option.classList.remove('selected', 'correct', 'incorrect');
                    option.querySelector('input[type="radio"]').checked = false;
                });
                quizContainer.querySelectorAll('.quiz-feedback').forEach(feedback => {
                    feedback.classList.remove('correct', 'incorrect');
                });
                quizResults.style.display = 'none';
                quizRetryBtn.classList.add('hidden');
                quizSubmitBtn.textContent = 'Submit Quiz';
                quizProgressBar.style.width = '0%';
                quizSubmitted = false;
                score = 0;
            });
        }

        // Handle quiz continue
        if (quizContinueBtn) {
            quizContinueBtn.addEventListener('click', () => {
                if (quizContainerId === 'final-quiz-container') {
                    document.getElementById('course-completion-form').submit();
                }
            });
        }
    }

    enableCompleteCourseButton() {
        const completeCourseBtn = document.getElementById('complete-course-btn');
        if (!completeCourseBtn) return;

        completeCourseBtn.disabled = false;
        completeCourseBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
        completeCourseBtn.classList.add('bg-green-500', 'hover:bg-green-600');
    }

    initializeCourseCompletion() {
        const completeCourseBtn = document.getElementById('complete-course-btn');
        const courseCompletionForm = document.getElementById('course-completion-form');

        if (!completeCourseBtn || !courseCompletionForm) return;

        // Initialize button state
        this.updateCourseCompletionButton();

        // Handle form submission
        courseCompletionForm.addEventListener('submit', (e) => {
            // Show loading state
            const originalText = completeCourseBtn.innerHTML;
            completeCourseBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Completing...';
            completeCourseBtn.disabled = true;
        });
    }

    initializeVideoPlayer() {
        const videoPlayer = document.getElementById('lesson-video');
        if (!videoPlayer) return;

        const speedControl = document.getElementById('speed-control');
        if (!speedControl) return;

        const player = videojs('lesson-video', {
            controls: true,
            autoplay: false,
            preload: 'auto',
            fluid: true
        });

        const speeds = [0.5, 0.75, 1, 1.25, 1.5, 2];
        let currentSpeedIndex = 2; // Start at 1x (index 2)

        speedControl.addEventListener('click', () => {
            currentSpeedIndex = (currentSpeedIndex + 1) % speeds.length;
            player.playbackRate(speeds[currentSpeedIndex]);
            speedControl.textContent = `${speeds[currentSpeedIndex]}x Speed`;
        });
    }

    initialize() {
        // Update displays first
        this.updateProgressDisplay();
        this.updateCompleteButton();

        // Set up event listeners
        const markCompleteBtn = document.getElementById('mark-complete-btn');
        if (markCompleteBtn) {
            markCompleteBtn.addEventListener('click', () => {
                const isNowCompleted = this.toggleLessonCompletion(this.currentSection, this.currentLesson);
                this.updateCompleteButton();
                this.updateProgressDisplay();
                this.saveProgress();
            });
        }

        const saveProgressBtn = document.getElementById('save-progress-btn');
        if (saveProgressBtn) {
            saveProgressBtn.addEventListener('click', () => {
                this.saveProgress();
            });
        }

        // Debug button
        document.getElementById('debug-check')?.addEventListener('click', () => {
            console.log("--- MANUAL REQUIREMENTS CHECK ---");
            console.log("Completed lessons:", this.completedLessons);
            console.log("Completed quizzes:", this.completedQuizzes);
            console.log("All requirements met?", this.checkAllRequirementsMet());
            this.updateCourseCompletionButton();
        });

        // Initialize components
        this.initializeVideoPlayer();
        this.initializeQuiz('quiz-container');
        this.initializeQuiz('final-quiz-container');
        this.initializeCourseCompletion();
    }
}

// Export for module system if needed
if (typeof module !== 'undefined' && module.exports) {
    module.exports = CourseProgress;
} else {
    // Make available globally
    window.CourseProgress = CourseProgress;
}
