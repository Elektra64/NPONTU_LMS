document.addEventListener('DOMContentLoaded', function() {
    // Get certificate data from HTML attributes
    const certificateContainer = document.getElementById('certificateData');
    const certificate = JSON.parse(certificateContainer.dataset.certificate);
    const shareUrl = certificateContainer.dataset.shareUrl;

    // Puzzle verification system
    const puzzlePieces = ['A', 'B', 'C', 'D', 'E', 'F'];
    const correctOrder = ['A', 'B', 'C', 'D', 'E', 'F'];
    let currentOrder = [...puzzlePieces].sort(() => Math.random() - 0.5);
    let draggedPiece = null;

    // Initialize puzzle
    function initializePuzzle() {
        const puzzleContainer = document.getElementById('puzzleContainer');
        const targetContainer = document.getElementById('targetContainer');

        // Clear containers
        puzzleContainer.innerHTML = '';
        targetContainer.innerHTML = '';

        // Create shuffled puzzle pieces
        currentOrder.forEach((piece, index) => {
            const pieceElement = document.createElement('div');
            pieceElement.className = 'puzzle-piece bg-white p-4 rounded border border-gray-300 text-center font-bold cursor-move';
            pieceElement.textContent = piece;
            pieceElement.dataset.value = piece;
            pieceElement.draggable = true;

            pieceElement.addEventListener('dragstart', (e) => {
                draggedPiece = e.target;
                e.dataTransfer.setData('text/plain', piece);
            });

            puzzleContainer.appendChild(pieceElement);
        });

        // Create target slots
        correctOrder.forEach((piece, index) => {
            const slotElement = document.createElement('div');
            slotElement.className = 'puzzle-slot p-4 text-center';
            slotElement.dataset.expected = piece;
            slotElement.dataset.filled = 'false';

            slotElement.addEventListener('dragover', (e) => {
                e.preventDefault();
            });

            slotElement.addEventListener('drop', (e) => {
                e.preventDefault();
                if (slotElement.dataset.filled === 'false' && draggedPiece) {
                    slotElement.textContent = draggedPiece.textContent;
                    slotElement.style.backgroundColor = '#f0fdf4';
                    slotElement.style.border = '2px solid #22c55e';
                    slotElement.dataset.filled = 'true';
                    draggedPiece.style.display = 'none';
                    draggedPiece = null;
                }
            });

            targetContainer.appendChild(slotElement);
        });
    }

    // Show puzzle modal when download button clicked
    document.getElementById('downloadBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        initializePuzzle();
        document.getElementById('puzzleModal').classList.remove('hidden');
    });

    // Cancel button
    document.getElementById('cancelBtn')?.addEventListener('click', function() {
        document.getElementById('puzzleModal').classList.add('hidden');
    });

    // Verify button
    document.getElementById('verifyBtn')?.addEventListener('click', function() {
        const slots = document.querySelectorAll('#targetContainer [data-filled="true"]');
        let isCorrect = true;

        slots.forEach(slot => {
            if (slot.textContent !== slot.dataset.expected) {
                isCorrect = false;
            }
        });

        if (isCorrect && slots.length === correctOrder.length) {
            document.getElementById('puzzleModal').classList.add('hidden');

            // Trigger PDF download instead of print
            window.location.href = shareUrl + '?download=true';
        } else {
            alert('Please complete the puzzle correctly before downloading.');
        }
    });

    // Share functionality
    window.shareCertificate = function(platform) {
        const title = 'My EduVerse Certificate';
        const text = `I completed ${certificate.course.title} with score ${certificate.completion_details.score}%`;

        let shareUrl;
        switch(platform) {
            case 'facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`;
                break;
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(shareUrl)}`;
                break;
            case 'linkedin':
                shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(shareUrl)}`;
                break;
            case 'whatsapp':
                shareUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + shareUrl)}`;
                break;
        }

        if (shareUrl) window.open(shareUrl, '_blank', 'width=600,height=400');
    };

    window.copyCertificateLink = function() {
        navigator.clipboard.writeText(shareUrl)
            .then(() => alert('Certificate link copied to clipboard!'))
            .catch(() => {
                // Fallback for browsers that don't support clipboard API
                const input = document.createElement('input');
                input.value = shareUrl;
                document.body.appendChild(input);
                input.select();
                document.execCommand('copy');
                document.body.removeChild(input);
                alert('Link copied!');
            });
    };

    // Populate certificate data
    if (certificate) {
        document.getElementById('learnerName').textContent = certificate.user.name;
        document.getElementById('courseTitle').textContent = certificate.course.title;
        document.getElementById('completionScore').textContent = certificate.completion_details.score + '%';
        document.getElementById('instructorName').textContent = certificate.instructor.name;
        document.getElementById('certificateId').textContent = certificate.certificate_info.id;
        document.getElementById('issueDate').textContent = certificate.certificate_info.issued_date;
        document.getElementById('verificationCode').textContent = certificate.certificate_info.verification_code;

        // Set user avatar if exists
        if (certificate.user.avatar) {
            const avatarElements = document.querySelectorAll('img[alt="User"]');
            avatarElements.forEach(img => {
                img.src = certificate.user.avatar;
            });
        }
    }
});
