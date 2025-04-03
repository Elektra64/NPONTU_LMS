// Function to handle login form submission
async function handleLogin(event) {
    event.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const remember = document.getElementById('remember').checked;
    const form = document.querySelector(`form[action="{{ route('login') }}"]`);
    const csrfToken = form.querySelector('input[name="_token"]').value;

    // Form validation
    if (!email || !password) {
        alert('Please fill in all fields');
        return;
    }

    try {
        const response = await fetch("http://127.0.0.1:8000/api/user/login", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                email: email,
                password: password,
                remember: remember
            })
        });

        const data = await response.json();

        if (response.ok) {
            // Successful login - redirect to dashboard or home page
            window.location.href = data.redirect || '/dashboard';
        } else {
            // Display error message
            alert(data.message || 'Login failed. Please try again.');
        }
    } catch (error) {
        console.error('Login error:', error);
        alert('An error occurred during login. Please try again.');
    }
}

// Add event listeners
document.addEventListener('DOMContentLoaded', () => {
    // Form animation
    const form = document.querySelector('.form-container');
    form.style.opacity = '0';
    form.style.transform = 'translateY(20px)';

    setTimeout(() => {
        form.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        form.style.opacity = '1';
        form.style.transform = 'translateY(0)';
    }, 100);

    // Add form submission handler to the form
    const loginForm = document.querySelector(`form[action="{{ route('login') }}"]`);
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }

    // Add click handler to the submit button
    const submitButton = document.querySelector('.submitFormButton');
    if (submitButton) {
        submitButton.addEventListener('click', function(event) {
            // Prevent default form submission (we'll handle it via API)
            event.preventDefault();

            // Get the form and trigger submit event
            const form = document.querySelector(`form[action="{{ route('login') }}"]`);
            if (form) {
                // Create and dispatch a submit event
                const submitEvent = new Event('submit', {
                    bubbles: true,
                    cancelable: true
                });
                form.dispatchEvent(submitEvent);
            }
        });
    }
});

// Function to toggle password visibility
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                             <circle cx="12" cy="12" r="3"></circle>
                             <line x1="3" y1="3" x2="21" y2="21"></line>`;
    } else {
        passwordInput.type = "password";
        eyeIcon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                             <circle cx="12" cy="12" r="3"></circle>`;
    }
}
