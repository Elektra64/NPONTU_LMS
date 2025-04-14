document.addEventListener('DOMContentLoaded', function() {
    const downloadBtn = document.getElementById('downloadBtn');
    const shareBtn = document.getElementById('shareBtn');
    const shareDropdown = document.getElementById('shareDropdown');

    // Download button functionality
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function() {
            // Optionally hide elements just before printing if CSS isn't enough
             // document.querySelectorAll('.no-print').forEach(el => el.style.display = 'none');
            window.print();
            // Optionally restore elements after print dialog closes (can be unreliable)
            // setTimeout(() => {
            //      document.querySelectorAll('.no-print').forEach(el => el.style.display = '');
            // }, 500);
        });
    }

    // Share button toggle
     if (shareBtn && shareDropdown) {
         shareBtn.addEventListener('click', function(e) {
             e.stopPropagation(); // Prevent click from immediately closing dropdown
             shareDropdown.classList.toggle('hidden');
             shareDropdown.classList.toggle('visible'); // Use a class for visibility state
         });
     }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
         if (shareDropdown && shareDropdown.classList.contains('visible')) {
             // Check if the click was outside the share container
             if (!shareBtn.contains(e.target) && !shareDropdown.contains(e.target)) {
                 shareDropdown.classList.add('hidden');
                 shareDropdown.classList.remove('visible');
             }
         }
     });


    // Handle name form submission (if applicable, although hidden in print)
    const nameForm = document.querySelector('.name-input-form');
    if (nameForm) {
        nameForm.addEventListener('submit', function(e) {
            const nameInput = this.querySelector('input[name="student_name"]');
            if (nameInput && !nameInput.value.trim()) {
                e.preventDefault();
                nameInput.focus();
                alert('Please enter your name to continue.');
            }
        });
    }

    // Celebration animation with confetti
     if (typeof confetti === 'function') { // Check if confetti library loaded
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
         function animateConfetti() {
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
                 const slowdownFactor = Math.max(0, 1 - (elapsed / duration)); // Ensure factor doesn't go negative
                 const delay = 50 + (150 * slowdownFactor); // Adjust timing

                 requestAnimationFrame(animateConfetti); // Use requestAnimationFrame for smoother animation
             }
         }

         // Start the animation after a slight delay
         setTimeout(() => requestAnimationFrame(animateConfetti), 500);
     } else {
         console.warn("Confetti library not loaded.");
     }
});

// Share functions (remain outside DOMContentLoaded)
function shareCertificate(platform) {
    // Ensure we get the current URL, possibly after name edit if URL changes
    const url = window.location.href;
    // Try to find the course title element robustly
    const courseTitleEl = document.querySelector('.course-title');
    const courseTitle = courseTitleEl ? courseTitleEl.textContent.trim() : "the course"; // Fallback text
    const studentNameEl = document.querySelector('.student-name');
    const studentName = studentNameEl ? studentNameEl.textContent.trim() : "I"; // Fallback name

    const text = `${studentName} earned a certificate for completing "${courseTitle}" on EduVerse! Check it out:`;

    let shareUrl;
    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}&quote=${encodeURIComponent(text)}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
            break;
        case 'linkedin':
             // LinkedIn prefers sharing the URL and letting the user add text
             shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
            break;
        case 'whatsapp':
            shareUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`;
            break;
        default:
            console.error("Unknown share platform:", platform);
            return;
    }
    window.open(shareUrl, '_blank', 'width=600,height=400,noopener,noreferrer');
}

function copyCertificateLink() {
    const url = window.location.href;
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url).then(() => {
            alert('Certificate link copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy using navigator.clipboard:', err);
            // Fallback for browsers without clipboard API or if it fails (e.g., insecure context)
            fallbackCopyTextToClipboard(url);
        });
    } else {
        // Fallback for older browsers
        fallbackCopyTextToClipboard(url);
    }
}

// Fallback copy function for older browsers or insecure contexts
function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;

    // Make the textarea offscreen
    textArea.style.position = 'fixed';
    textArea.style.top = '-9999px';
    textArea.style.left = '-9999px';

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        const successful = document.execCommand('copy');
        if (successful) {
             alert('Certificate link copied to clipboard! (Fallback method)');
        } else {
             alert('Failed to copy link. Please copy it manually.');
        }
    } catch (err) {
        console.error('Fallback copy failed:', err);
        alert('Failed to copy link. Please copy it manually.');
    }

    document.body.removeChild(textArea);
}
