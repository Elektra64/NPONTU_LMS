document.addEventListener('DOMContentLoaded', function() {
    // Video player initialization
    if (window.courseSettings.isVideo) {
        videojs('lesson-video', {
            controls: true,
            autoplay: false,
            preload: 'auto',
            fluid: true
        });
    }

    // Speed control button
    const speedControl = document.getElementById('speed-control');
    if (speedControl) {
        const speeds = [0.5, 0.75, 1, 1.25, 1.5, 2];
        let currentSpeed = 2;
        speedControl.addEventListener('click', function() {
            const video = videojs('lesson-video');
            currentSpeed = (currentSpeed + 1) % speeds.length;
            video.playbackRate(speeds[currentSpeed]);
            this.textContent = speeds[currentSpeed] + 'x Speed';
        });
    }

    // Mark as complete button
    const markCompleteBtn = document.getElementById('mark-complete-btn');
    if (markCompleteBtn) {
        markCompleteBtn.addEventListener('click', function() {
            // In a real app, you would save this to the database
            this.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Completed';
            this.classList.remove('bg-green-500', 'hover:bg-green-600');
            this.classList.add('bg-gray-400', 'cursor-not-allowed');
            this.disabled = true;

            // Update progress in sidebar
            const activeLesson = document.querySelector('.lesson-item.active');
            if (activeLesson) {
                activeLesson.classList.add('completed');
                const icon = activeLesson.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-play-circle', 'text-yellow-500');
                    icon.classList.add('fa-check-circle', 'text-green-500');
                }
            }
        });
    }

    // Quiz functionality
    if (window.courseSettings.hasFinalQuiz) {
        const quizForm = document.getElementById('quiz-form');
        const quizSubmitBtn = document.getElementById('quiz-submit-btn');
        const quizResults = document.getElementById('quiz-results');
        const quizRetryBtn = document.getElementById('quiz-retry-btn');
        const quizContinueBtn = document.getElementById('quiz-continue-btn');
        const completeCourseBtn = document.getElementById('complete-course-btn');
        const quizProgressBar = document.getElementById('quiz-progress-bar');

        let quizSubmitted = false;
        let score = 0;
        const totalQuestions = document.querySelectorAll('.quiz-question').length;

        // Update progress bar
        function updateQuizProgress() {
            const answered = document.querySelectorAll('.quiz-option.selected').length;
            const progress = (answered / totalQuestions) * 100;
            quizProgressBar.style.width = `${progress}%`;
        }

        // Select quiz options
        document.querySelectorAll('.quiz-option').forEach(option => {
            option.addEventListener('click', function() {
                if (quizSubmitted) return;

                const questionDiv = this.closest('.quiz-question');
                questionDiv.querySelectorAll('.quiz-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');

                updateQuizProgress();
            });
        });

        // Submit quiz
        quizForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (quizSubmitted) return;

            // Calculate score
            score = 0;
            document.querySelectorAll('.quiz-question').forEach(question => {
                const selectedOption = question.querySelector('.quiz-option.selected');
                if (selectedOption) {
                    const selectedValue = selectedOption.querySelector('input').value;
                    const correctAnswer = question.querySelector('.quiz-feedback').dataset.correct;

                    if (selectedValue === correctAnswer) {
                        score++;
                        selectedOption.classList.add('correct');
                    } else {
                        selectedOption.classList.add('incorrect');
                        // Highlight correct answer
                        question.querySelectorAll('.quiz-option').forEach(opt => {
                            if (opt.querySelector('input').value === correctAnswer) {
                                opt.classList.add('correct');
                            }
                        });
                    }

                    // Show feedback
                    question.querySelector('.quiz-feedback').classList.add(
                        selectedValue === correctAnswer ? 'correct' : 'incorrect'
                    );
                }
            });

            // Calculate percentage
            const percentage = Math.round((score / totalQuestions) * 100);
            const passed = percentage >= window.courseSettings.passingScore;

            // Show results
            quizResults.style.display = 'block';
            quizResults.classList.add(passed ? 'passed' : 'failed');
            quizResults.querySelector('h3').textContent = passed ?
                'Quiz Passed!' : 'Quiz Failed';
            quizResults.querySelector('p').textContent =
                `You scored ${percentage}% (${score} out of ${totalQuestions} correct). ` +
                (passed ?
                    'Congratulations! You can now complete the course.' :
                    `You need at least ${window.courseSettings.passingScore}% to pass. Please try again.`);

            // Show appropriate buttons
            if (passed) {
                quizContinueBtn.classList.remove('hidden');
                completeCourseBtn.disabled = false;
            } else {
                quizRetryBtn.classList.remove('hidden');
            }

            quizSubmitBtn.disabled = true;
            quizSubmitted = true;
        });

        // Retry quiz
        quizRetryBtn.addEventListener('click', function() {
            document.querySelectorAll('.quiz-option').forEach(option => {
                option.classList.remove('selected', 'correct', 'incorrect');
            });
            document.querySelectorAll('.quiz-feedback').forEach(feedback => {
                feedback.classList.remove('correct', 'incorrect');
            });
            quizResults.style.display = 'none';
            quizResults.classList.remove('passed', 'failed');
            quizRetryBtn.classList.add('hidden');
            quizSubmitBtn.disabled = false;
            quizSubmitted = false;
            score = 0;
            quizProgressBar.style.width = '0%';
        });

        // Continue to completion
        quizContinueBtn.addEventListener('click', function() {
            document.getElementById('course-completion-form').submit();
        });
    }
    
});
