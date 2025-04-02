// DOM Content Loaded Event
document.addEventListener("DOMContentLoaded", () => {
    // Initialize form animation
    const formContainer = document.querySelector(".form-container");
    if (formContainer) {
        formContainer.style.opacity = "0";
        formContainer.style.transform = "translateY(20px)";

        setTimeout(() => {
            formContainer.style.transition =
                "opacity 0.5s ease, transform 0.5s ease";
            formContainer.style.opacity = "1";
            formContainer.style.transform = "translateY(0)";
        }, 100);
    }

    // Initialize role selection
    initializeRoleSelection();

    // Add form submission handler
    const signupForm = document.querySelector(`submitSignupForm"]`);
    if (signupForm) {
        signupForm.addEventListener("click", handleSignup);
    }
});

// Role Selection Functionality
function initializeRoleSelection() {
    const roleRadios = document.querySelectorAll(".role-option input");

    roleRadios.forEach((radio) => {
        radio.addEventListener("change", function () {
            document.querySelectorAll(".role-option div").forEach((div) => {
                div.classList.remove("border-primary", "bg-primary/5");
            });
            if (this.checked) {
                this.nextElementSibling.classList.add(
                    "border-primary",
                    "bg-primary/5"
                );
            }
        });
    });

    // Initialize the checked state
    const checkedRadio = document.querySelector(".role-option input:checked");
    if (checkedRadio) {
        checkedRadio.nextElementSibling.classList.add(
            "border-primary",
            "bg-primary/5"
        );
    }
}

// Form Submission Handler
async function handleSignup() {
    const form = document.getElementById("signUpForm");
    const formData = new FormData(form);

    try {
        const response = await fetch(
            "http://127.0.0.1:8000/api/user/register",
            {
                method: "POST",
                headers: {
                    Accept: "application/json",
                },
                body: formData,
            }
        );

        const data = await response.json();

        if (response.ok && response.status == 100) {
            // Successful signup - redirect
            window.location.href = "/dashboard";
        } else {
            // Display error messages
            displayFormErrors(
                data.errors || {
                    message: data.message || "Signup failed. Please try again.",
                }
            );
        }
    } catch (error) {
        console.error("Signup error:", error.message);
        displayFormErrors({
            message: "An error occurred during signup. Please try again.",
        });
    }
}

// Error Display
function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    if (field) {
        field.classList.add("border-red-500");

        const error = document.createElement("p");
        error.className = "error-message text-red-500 text-xs mt-1";
        error.textContent = message;
        field.parentNode.appendChild(error);
    }
}

// Display Form Errors from Server
function displayFormErrors(errors) {
    // Clear previous errors
    document.querySelectorAll(".border-red-500").forEach((el) => {
        el.classList.remove("border-red-500");
    });
    document.querySelectorAll(".error-message").forEach((el) => el.remove());

    if (errors.message) {
        // General error message
        alert(errors.message);
        return;
    }

    // Field-specific errors
    for (const [field, message] of Object.entries(errors)) {
        showError(field, Array.isArray(message) ? message[0] : message);
    }
}
