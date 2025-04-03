document.addEventListener('DOMContentLoaded', function() {
    const puzzlePiece = document.getElementById('puzzlePiece');
    const puzzleTarget = document.querySelector('.puzzle-target');
    const successCheck = document.querySelector('.success-check');
    const verificationMessage = document.getElementById('verificationMessage');
    const enrollForm = document.getElementById('enrollForm');

    let isDragging = false;
    let isVerified = false;
    let offsetX, offsetY;

    // Mouse down event
    puzzlePiece.addEventListener('mousedown', function(e) {
        if (isVerified) return;

        isDragging = true;
        offsetX = e.clientX - puzzlePiece.getBoundingClientRect().left;
        offsetY = e.clientY - puzzlePiece.getBoundingClientRect().top;
        puzzlePiece.style.cursor = 'grabbing';
    });

    // Mouse move event
    document.addEventListener('mousemove', function(e) {
        if (!isDragging || isVerified) return;

        e.preventDefault();

        const containerRect = document.querySelector('.puzzle-container').getBoundingClientRect();
        const maxX = containerRect.width - puzzlePiece.offsetWidth;
        const maxY = containerRect.height - puzzlePiece.offsetHeight;

        let x = e.clientX - containerRect.left - offsetX;
        let y = e.clientY - containerRect.top - offsetY;

        // Constrain within container
        x = Math.max(0, Math.min(x, maxX));
        y = Math.max(0, Math.min(y, maxY));

        puzzlePiece.style.left = `${x}px`;
        puzzlePiece.style.top = `${y}px`;

        // Check if piece is in target
        const pieceRect = puzzlePiece.getBoundingClientRect();
        const targetRect = puzzleTarget.getBoundingClientRect();

        if (
            pieceRect.right > targetRect.left &&
            pieceRect.left < targetRect.right &&
            pieceRect.bottom > targetRect.top &&
            pieceRect.top < targetRect.bottom
        ) {
            // Snap to target
            puzzlePiece.style.left = `${maxX - 10}px`;
            puzzlePiece.style.top = '10px';
            isDragging = false;
            puzzlePiece.style.cursor = 'default';

            // Show success
            setTimeout(() => {
                puzzlePiece.style.display = 'none';
                successCheck.style.display = 'block';
                verificationMessage.textContent = 'Verification successful!';
                verificationMessage.className = 'text-sm text-center text-green-500 mt-2';

                // Show enrollment form
                enrollForm.classList.remove('hidden');
                isVerified = true;
            }, 300);
        }
    });

    // Mouse up event
    document.addEventListener('mouseup', function() {
        if (isDragging && !isVerified) {
            // Return to start position if not in target
            puzzlePiece.style.left = '10px';
            puzzlePiece.style.top = '10px';
            puzzlePiece.style.cursor = 'grab';
        }
        isDragging = false;
    });

    // Touch events for mobile
    puzzlePiece.addEventListener('touchstart', function(e) {
        if (isVerified) return;

        isDragging = true;
        const touch = e.touches[0];
        offsetX = touch.clientX - puzzlePiece.getBoundingClientRect().left;
        offsetY = touch.clientY - puzzlePiece.getBoundingClientRect().top;
    });

    document.addEventListener('touchmove', function(e) {
        if (!isDragging || isVerified) return;

        e.preventDefault();
        const touch = e.touches[0];

        const containerRect = document.querySelector('.puzzle-container').getBoundingClientRect();
        const maxX = containerRect.width - puzzlePiece.offsetWidth;
        const maxY = containerRect.height - puzzlePiece.offsetHeight;

        let x = touch.clientX - containerRect.left - offsetX;
        let y = touch.clientY - containerRect.top - offsetY;

        x = Math.max(0, Math.min(x, maxX));
        y = Math.max(0, Math.min(y, maxY));

        puzzlePiece.style.left = `${x}px`;
        puzzlePiece.style.top = `${y}px`;

        // Check if piece is in target
        const pieceRect = puzzlePiece.getBoundingClientRect();
        const targetRect = puzzleTarget.getBoundingClientRect();

        if (
            pieceRect.right > targetRect.left &&
            pieceRect.left < targetRect.right &&
            pieceRect.bottom > targetRect.top &&
            pieceRect.top < targetRect.bottom
        ) {
            // Snap to target
            puzzlePiece.style.left = `${maxX - 10}px`;
            puzzlePiece.style.top = '10px';
            isDragging = false;

            // Show success
            setTimeout(() => {
                puzzlePiece.style.display = 'none';
                successCheck.style.display = 'block';
                verificationMessage.textContent = 'Verification successful!';
                verificationMessage.className = 'text-sm text-center text-green-500 mt-2';

                // Show enrollment form
                enrollForm.classList.remove('hidden');
                isVerified = true;
            }, 300);
        }
    });

    document.addEventListener('touchend', function() {
        if (isDragging && !isVerified) {
            // Return to start position if not in target
            puzzlePiece.style.left = '10px';
            puzzlePiece.style.top = '10px';
        }
        isDragging = false;
    });

    // Form submission
    enrollForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!isVerified) {
            alert('Please complete the verification first');
            return;
        }

        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';

        // Simulate form processing
        setTimeout(() => {
            // Show success message
            this.innerHTML = `
                <div class="text-center py-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <i class="fas fa-check text-3xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Enrollment Successful!</h3>
                    <p class="text-gray-600 mb-6">You're now enrolled in the course. Check your email for confirmation.</p>
                    <a href="/dashboard" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-6 py-2 rounded-lg transition duration-300">
                        Go to Dashboard
                    </a>
                </div>
            `;
        }, 1500);
    });
});
