document.addEventListener('DOMContentLoaded', function() {
    // Safely get enrollment data with null checks
    const enrollmentData = document.getElementById('enrollmentData');
    if (!enrollmentData) {
        console.error('Enrollment data container not found');
        return;
    }

    try {
        const courseData = JSON.parse(enrollmentData.dataset.course || 'null');
        const userData = JSON.parse(enrollmentData.dataset.user || 'null');
        const completeUrl = enrollmentData.dataset.completeUrl;

        if (!courseData || !userData || !completeUrl) {
            throw new Error('Missing required enrollment data');
        }

        const completeBtn = document.getElementById('completeEnrollment');
        const termsCheckbox = document.getElementById('terms');

        if (!completeBtn || !termsCheckbox) {
            throw new Error('Required form elements not found');
        }

        completeBtn.addEventListener('click', async function(e) {
            e.preventDefault();

            if (!termsCheckbox.checked) {
                alert('Please agree to the terms and conditions');
                return;
            }

            let selectedPackage = 'free';
            const selectedOption = document.querySelector('.package-option.selected');
            if (selectedOption) {
                selectedPackage = selectedOption.id.replace('Package', '').toLowerCase();
            }

            completeBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
            completeBtn.disabled = true;

            try {
                const response = await fetch(completeUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
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

                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            } catch (error) {
                console.error('Enrollment error:', error);
                alert(error.message || 'There was an error processing your enrollment. Please try again.');
                completeBtn.innerHTML = 'Complete Enrollment <i class="fas fa-arrow-right ml-2"></i>';
                completeBtn.disabled = false;
            }
        });

        // Package selection functionality
        const packageOptions = document.querySelectorAll('.package-option');
        if (packageOptions.length > 0) {
            packageOptions.forEach(option => {
                option.addEventListener('click', function() {
                    packageOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');

                    const paymentSection = document.getElementById('paymentSection');
                    if (paymentSection) {
                        paymentSection.classList.toggle('hidden', this.id === 'freePackage');
                    }
                });
            });
        }
    } catch (error) {
        console.error('Initialization error:', error);
        alert('There was an error loading the enrollment page. Please refresh and try again.');
    }
});
