document.addEventListener('DOMContentLoaded', function() {
    // Get course details from URL
    const urlParams = new URLSearchParams(window.location.search);
    const courseId = urlParams.get('id');
    const isFreeCourse = urlParams.get('isFree') === 'true'; // Default to free

    // Set course details
    document.getElementById('courseTitle').textContent =
        urlParams.get('title') || "Selected Course";

    // In a real app, you would fetch these from your database
    const courseDetails = {
        description: "Master HTML, CSS, JavaScript, React, Node.js and more with this comprehensive course.",
        rating: "4.9",
        students: "12,345",
        hasPaidOptions: false // Set to true if course has paid versions
    };

    document.getElementById('courseDescription').textContent = courseDetails.description;
    document.getElementById('courseRating').textContent = courseDetails.rating;
    document.getElementById('courseStudents').textContent = courseDetails.students;

    // Show package selection if course has paid options
    if (courseDetails.hasPaidOptions) {
        document.getElementById('packageSelection').classList.remove('hidden');

        // Package selection logic
        const packageOptions = document.querySelectorAll('.package-option');
        packageOptions.forEach(option => {
            option.addEventListener('click', function() {
                packageOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');

                // Show payment section if not free package
                if (this.id !== 'freePackage') {
                    document.getElementById('paymentSection').classList.remove('hidden');
                } else {
                    document.getElementById('paymentSection').classList.add('hidden');
                }
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

    // Handle enrollment
    document.getElementById('completeEnrollment').addEventListener('click', function() {
        if (!document.getElementById('terms').checked) {
            alert('Please agree to the terms and conditions');
            return;
        }

        const button = this;
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
        button.disabled = true;

        // Simulate API call
        setTimeout(() => {
            alert('Enrollment successful! You now have full access to this course.');
            window.location.href = '/course-content?id=' + courseId;
        }, 1500);
    });
});
