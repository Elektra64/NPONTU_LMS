 // Main DOMContentLoaded event listener
 document.addEventListener('DOMContentLoaded', function() {
    // Download button functionality
    document.getElementById('downloadBtn').addEventListener('click', function() {
        // Trigger print functionality
        window.print();
    });

    // Share button toggle
    document.getElementById('shareBtn').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('shareDropdown').classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        document.getElementById('shareDropdown').classList.add('hidden');
    });

    // Handle name form submission
    const nameForm = document.querySelector('.name-form');
    if (nameForm) {
        nameForm.addEventListener('submit', function(e) {
            const nameInput = this.querySelector('input[name="student_name"]');
            if (!nameInput.value.trim()) {
                e.preventDefault();
                nameInput.focus();
                alert('Please enter your name to continue.');
            }
        });
    }

    // Celebration animation with 5-second duration
    const startTime = Date.now();
    const duration = 5000; // 5 seconds

    // Initial burst
    confetti({
        particleCount: 150,
        spread: 70,
        origin: { y: 0.6 }
    });

    // Add some stars for extra celebration
    const starColors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];

    function randomInRange(min, max) {
        return Math.random() * (max - min) + min;
    }

    // Animation loop
    function animate() {
        const elapsed = Date.now() - startTime;

        if (elapsed < duration) {
            // Continue animation
            confetti({
                particleCount: 5,
                angle: randomInRange(55, 125),
                spread: randomInRange(50, 70),
                origin: { y: 0.6 },
                colors: starColors,
                shapes: ['star']
            });

            // Slow down the animation as we approach the end
            const slowdownFactor = 1 - (elapsed / duration);
            const delay = 100 * slowdownFactor;

            setTimeout(animate, delay);
        }
    }

    // Start the animation after a slight delay
    setTimeout(animate, 500);
});

// Share functions
function shareCertificate(platform) {
    const url = window.location.href;
    const courseTitle = document.querySelector('h3.text-yellow-600').textContent;
    const text = `I earned a certificate for completing "${courseTitle}"! Check it out:`;

    let shareUrl;
    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}&quote=${encodeURIComponent(text)}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
            break;
        case 'linkedin':
            shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
            break;
        case 'whatsapp':
            shareUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`;
            break;
    }
    window.open(shareUrl, '_blank', 'width=600,height=400');
}

function copyCertificateLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        alert('Certificate link copied to clipboard!');
    }).catch(err => {
        // Fallback for older browsers
        const input = document.createElement('input');
        input.value = url;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
        alert('Link copied!');
    });
}
