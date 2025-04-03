document.addEventListener('DOMContentLoaded', function() {
    // Get data container element
    const dataContainer = document.getElementById('enrollmentData');

    // Parse JSON data from data attributes
    const courseData = JSON.parse(dataContainer.dataset.course);
    const userData = JSON.parse(dataContainer.dataset.user);
    const enrollmentData = JSON.parse(dataContainer.dataset.enrollment);
    const hasPaidOptions = dataContainer.dataset.hasPaidOptions === 'true';
    const completeUrl = dataContainer.dataset.completeUrl;

    // Set course details
    document.getElementById('courseTitle').textContent = courseData.title;
    document.getElementById('courseDescription').textContent = courseData.description;
    document.getElementById('courseRating').textContent = courseData.rating;
    document.getElementById('courseStudents').textContent =
        courseData.students_count.toLocaleString() + ' students';

    // Set user details
    document.querySelector('input[value="John Doe"]').value = userData.name;
    document.querySelector('input[value="john@example.com"]').value = userData.email;

    // Show package selection if course has paid options
    if (hasPaidOptions) {
        document.getElementById('packageSelection').classList.remove('hidden');

        // Set initial package selection based on session
        const initialPackage = enrollmentData.package || 'free';
        document.getElementById(initialPackage + 'Package').classList.add('selected');

        // Hide payment section if free package selected
        if (initialPackage === 'free') {
            document.getElementById('paymentSection').classList.add('hidden');
        }

        // Set package prices
        document.getElementById('standardPrice').textContent =
            '$' + courseData.standard_price.toFixed(2);
        document.getElementById('premiumPrice').textContent =
            '$' + courseData.premium_price.toFixed(2);

        // Package selection logic
        const packageOptions = document.querySelectorAll('.package-option');
        packageOptions.forEach(option => {
            option.addEventListener('click', function() {
                packageOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');

                // Show payment section if not free package
                document.getElementById('paymentSection').classList.toggle('hidden',
                    this.id === 'freePackage');
            });
        });
    }

    // Payment method selection
    const paymentMethods = document.querySelectorAll('.payment-method');
    paymentMethods.forEach(method => {
        method.addEventListener('click', function() {
            paymentMethods.forEach(m => m.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Handle enrollment submission
    document.getElementById('completeEnrollment').addEventListener('click', function(e) {
        e.preventDefault();

        // Validate terms
        if (!document.getElementById('terms').checked) {
            alert('Please agree to the terms and conditions');
            return;
        }

        // Get selected package
        let selectedPackage = 'free';
        const selectedOption = document.querySelector('.package-option.selected');
        if (selectedOption) {
            selectedPackage = selectedOption.id.replace('Package', '').toLowerCase();
        }

        // Show loading state
        const button = this;
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
        button.disabled = true;

        // Submit form data
        const formData = new FormData();
        formData.append('package', selectedPackage);
        formData.append('terms', 'on');
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        fetch(completeUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(() => {
            // Redirect to completion page
            window.location.href = completeUrl;
        })
        .catch(error => {
            console.error('Error:', error);
            button.innerHTML = 'Complete Enrollment <i class="fas fa-arrow-right ml-2"></i>';
            button.disabled = false;
            alert('There was an error processing your enrollment. Please try again.');
        });
    });
});
