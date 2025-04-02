// Function to handle login form submission
async function handleLogin() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const remember = document.getElementById("remember").checked;

    // Form validation~
    if (!email || !password) {
        alert("Please fill in all fields");
        return;
    }

    try {
        const response = await fetch("http://127.0.0.1:8000/api/user/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                // "X-CSRF-TOKEN": document
                //     .querySelector('meta[name="csrf-token"]')
                //     .getAttribute("content"),
            },
            body: JSON.stringify({
                email: email,
                password: password,
                remember: remember,
            }),
        });

        const data = await response.json();

        if (response.ok && response.status == 100) {
            // Successful login - redirect to dashboard or home page
            alert("successful");
            window.location.href = "/dashboard";
        } else {
            // Display error message
            alert(data.message || "Login failed. Please try again.");
        }
    } catch (error) {
        console.error("Login error:", error.message);
        alert("An error occurred during login. Please try again.");
        window.location.href = "/signUp";
    }
}

// Add event listener to the form
document.addEventListener("DOMContentLoaded", () => {
    // Form animation
    const form = document.querySelector(".form-container");
    form.style.opacity = "0";
    form.style.transform = "translateY(20px)";

    setTimeout(() => {
        form.style.transition = "opacity 0.5s ease, transform 0.5s ease";
        form.style.opacity = "1";
        form.style.transform = "translateY(0)";
    }, 100);

    const submitFormButton = document.querySelector(".submitFormButton");
    if (submitFormButton) {
        submitFormButton.addEventListener("click", function (event) {
            event.preventDefault();
            handleLogin();
        });
    }

    // Add form submission handler
    // const loginForm = document.querySelector(`form[action="{{ route('login') }}"]`);
    // if (loginForm) {
    //     loginForm.addEventListener('submit', handleLogin);
    // }
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
