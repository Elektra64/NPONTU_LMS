document.addEventListener('DOMContentLoaded', function() {
    try {
        const puzzleContainer = document.getElementById('puzzleContainer');
        const targetContainer = document.getElementById('targetContainer');
        const solutionInput = document.getElementById('puzzleSolution');
        const pieces = ['A', 'B', 'C', 'D', 'E', 'F'];
        let correctOrder = [...pieces];
        let currentOrder = [...pieces].sort(() => Math.random() - 0.5);
        let placedPieces = Array(pieces.length).fill(null);

        // Create puzzle pieces
        currentOrder.forEach((piece, index) => {
            const pieceElement = createPuzzlePiece(piece);
            puzzleContainer.appendChild(pieceElement);
        });

        // Create target slots
        pieces.forEach((_, index) => {
            const slot = document.createElement('div');
            slot.className = 'target-slot';
            slot.dataset.position = index;

            // Drag and drop events for slots
            slot.addEventListener('dragover', (e) => {
                e.preventDefault();
                slot.classList.add('highlight');
            });

            slot.addEventListener('dragleave', () => {
                slot.classList.remove('highlight');
            });

            slot.addEventListener('drop', (e) => {
                e.preventDefault();
                slot.classList.remove('highlight');

                const pieceValue = e.dataTransfer.getData('text/plain');
                const pieceElement = document.querySelector(`.puzzle-piece[data-value="${pieceValue}"]`);

                if (pieceElement) {
                    // Remove from previous position if it was placed
                    if (pieceElement.dataset.placed === 'true') {
                        const oldPosition = pieceElement.dataset.position;
                        placedPieces[oldPosition] = null;
                    }

                    // Place in new slot
                    slot.innerHTML = '';
                    const clonedPiece = pieceElement.cloneNode(true);
                    clonedPiece.classList.remove('opacity-0');
                    clonedPiece.classList.add('mx-auto');
                    clonedPiece.draggable = false;
                    clonedPiece.dataset.placed = 'true';
                    clonedPiece.dataset.position = slot.dataset.position;
                    slot.appendChild(clonedPiece);

                    // Update placed pieces array
                    placedPieces[slot.dataset.position] = pieceValue;
                    updateSolutionInput();
                }
            });

            targetContainer.appendChild(slot);
        });

        function createPuzzlePiece(piece) {
            const pieceElement = document.createElement('div');
            pieceElement.className = 'puzzle-piece bg-yellow-500 text-black font-bold text-xl flex items-center justify-center h-16 rounded-lg cursor-move';
            pieceElement.textContent = piece;
            pieceElement.draggable = true;
            pieceElement.dataset.value = piece;

            pieceElement.addEventListener('dragstart', function(e) {
                e.dataTransfer.setData('text/plain', e.target.dataset.value);
                setTimeout(() => e.target.classList.add('opacity-0'), 0);
            });

            pieceElement.addEventListener('dragend', function() {
                this.classList.remove('opacity-0');
            });

            return pieceElement;
        }

        function updateSolutionInput() {
            solutionInput.value = JSON.stringify(placedPieces);
        }

        // Initialize with empty solution
        updateSolutionInput();

    } catch (error) {
        console.error('Puzzle initialization failed:', error);
        alert('Failed to load puzzle. Please refresh the page.');
    }
});
