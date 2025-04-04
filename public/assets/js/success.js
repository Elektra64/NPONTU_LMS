document.addEventListener('DOMContentLoaded', function() {
    // Get the enrollment button and form elements
    const completeBtn = document.getElementById('completeEnrollment');
    const termsCheckbox = document.getElementById('terms');
    const enrollmentData = document.getElementById('enrollmentData');

    // Parse the course data from the data attributes
    const courseData = JSON.parse(enrollmentData.dataset.course);
    const userData = JSON.parse(enrollmentData.dataset.user);
    const completeUrl = enrollmentData.dataset.completeUrl;

    // Set up the enrollment button click handler
    completeBtn.addEventListener('click', async function(e) {
        e.preventDefault();

        // Validate terms checkbox
        if (!termsCheckbox.checked) {
            alert('Please agree to the terms and conditions');
            return;
        }

        // Get selected package (default to free)
        let selectedPackage = 'free';
        const selectedOption = document.querySelector('.package-option.selected');
        if (selectedOption) {
            selectedPackage = selectedOption.id.replace('Package', '').toLowerCase();
        }

        // Show loading state
        completeBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
        completeBtn.disabled = true;

        try {
            // Submit enrollment data
            const response = await fetch(completeUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    package: selectedPackage,
                    terms: true,
                    name: userData.name,
                    email: userData.email,
                    course_id: courseData.id
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Enrollment failed');
            }

            // Redirect to course content on success
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        } catch (error) {
            console.error('Enrollment error:', error);
            alert(error.message || 'There was an error processing your enrollment. Please try again.');

            // Reset button state
            completeBtn.innerHTML = 'Complete Enrollment <i class="fas fa-arrow-right ml-2"></i>';
            completeBtn.disabled = false;
        }
    });

    // Package selection functionality (if applicable)
    const packageOptions = document.querySelectorAll('.package-option');
    if (packageOptions.length > 0) {
        packageOptions.forEach(option => {
            option.addEventListener('click', function() {
                packageOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');

                // Show/hide payment section based on selection
                const paymentSection = document.getElementById('paymentSection');
                if (paymentSection) {
                    paymentSection.classList.toggle('hidden', this.id === 'freePackage');
                }
            });
        });
    }
});
