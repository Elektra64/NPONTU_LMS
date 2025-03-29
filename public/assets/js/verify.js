document.addEventListener('DOMContentLoaded', function() {
    const puzzleContainer = document.getElementById('puzzleContainer');
    const targetContainer = document.getElementById('targetContainer');
    const solutionInput = document.getElementById('puzzleSolution');

    const pieces = ['A', 'B', 'C', 'D', 'E', 'F'];
    let correctOrder = [...pieces];
    let currentOrder = [...pieces].sort(() => Math.random() - 0.5);

    // Create puzzle pieces
    currentOrder.forEach(piece => {
        const pieceElement = document.createElement('div');
        pieceElement.className = 'puzzle-piece bg-yellow-500 text-black font-bold text-xl flex items-center justify-center h-16 rounded-lg cursor-move';
        pieceElement.textContent = piece;
        pieceElement.draggable = true;
        pieceElement.dataset.value = piece;

        pieceElement.addEventListener('dragstart', function(e) {
            e.dataTransfer.setData('text/plain', e.target.dataset.value);
            setTimeout(() => e.target.classList.add('opacity-0'), 0);
        });

        puzzleContainer.appendChild(pieceElement);
    });

    // Create target slots
    correctOrder.forEach((_, index) => {
        const slot = document.createElement('div');
        slot.className = 'target-slot bg-gray-600 border-2 border-dashed border-gray-500 h-16 rounded-lg';
        slot.dataset.position = index;

        slot.addEventListener('dragover', function(e) {
            e.preventDefault();
        });

        slot.addEventListener('drop', function(e) {
            e.preventDefault();
            const pieceValue = e.dataTransfer.getData('text/plain');
            const pieceElement = document.querySelector(`[data-value="${pieceValue}"]`);

            if (!e.target.hasChildNodes()) {
                e.target.appendChild(pieceElement);
                pieceElement.classList.remove('opacity-0');
                updateSolution();
            }
        });

        targetContainer.appendChild(slot);
    });

    function updateSolution() {
        const slots = targetContainer.querySelectorAll('.target-slot');
        const solution = Array.from(slots).map(slot => {
            return slot.firstChild ? slot.firstChild.dataset.value : null;
        });
        solutionInput.value = JSON.stringify(solution);
    }
});
