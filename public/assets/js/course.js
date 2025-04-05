//tailwind config
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: "#4A5568",
                secondary: "#718096",
                background: "#F7FAFC",
                "accent-light": "#E2E8F0",
                "accent-dark": "#2D3748",
                "fine-color": "#A1DBF1",
            },
            animation: {
                "fade-in": "fadeIn 0.5s ease-out",
                "slide-in-left": "slideInLeft 0.5s ease-out",
                "pulse-slow": "pulse 2s infinite",
            },
            keyframes: {
                fadeIn: {
                    "0%": { opacity: "0" },
                    "100%": { opacity: "1" },
                },
                slideInLeft: {
                    "0%": { transform: "translateX(-100%)", opacity: "0" },
                    "100%": { transform: "translateX(0)", opacity: "1" },
                },
            },
        },
    },
};


// DOM Elements
const courseModal = document.getElementById("courseModal");
const addCourseBtn = document.getElementById("addCourseBtn");
const addModuleModal = document.getElementById("addModuleModal");
const closeModalBtn = document.getElementById("closeModal");
const cancelCourseBtn = document.getElementById("cancelCourse");
const courseForm = document.getElementById("courseCreationForm");
const courseList = document.getElementById("courseList");
const modulesContainer = document.getElementById("modules-container");
const addModuleBtn = document.getElementById("add-module");
const moduleTemplate = document.getElementById("module-template");
const questionTemplate = document.getElementById("question-template");

// Modal Functions
function openModal(editMode = false) {
    if (editMode) {
        addModuleModal.classList.remove("hidden");
        document.body.style.overflow = "hidden";
    } else {
        document.querySelector("#courseModal h2").textContent =
            "Create New Course";
        document.querySelector(
            '#courseCreationForm button[type="submit"]'
        ).textContent = "Create Course";
        courseModal.classList.remove("hidden");
        document.body.style.overflow = "hidden";
    }
}

function closeModal() {
    courseModal.classList.add("hidden");
    document.body.style.overflow = "";
    courseForm.reset();
    modulesContainer.innerHTML = "";
}
function closeAddModuleModal() {
    addModuleModal.classList.add("hidden");
    document.body.style.overflow = "";
    modulesContainer.innerHTML = "";
}

// Initialize the page
document.addEventListener("DOMContentLoaded", function () {
    // Modal event listeners
    addCourseBtn.addEventListener("click", () => openModal());
    closeModalBtn.addEventListener("click", closeModal);
    cancelCourseBtn.addEventListener("click", closeModal);

    // Add module button
    addModuleBtn.addEventListener("click", addModule);
});

// Add a new module
function addModule() {
    const moduleClone = moduleTemplate.content.cloneNode(true);
    modulesContainer.appendChild(moduleClone);
}

// Add a new question to a module
function addQuestion() {
    const quizQuestionsContainer = document.querySelector(".quiz-questions");
    const questionClone = questionTemplate.content.cloneNode(true);
    // Add to container
    quizQuestionsContainer.appendChild(questionClone);
}

// Delete Course Function
function deleteCourse(element) {
    if (confirm("Are you sure you want to delete this course?")) {
        // redirect to backend for deletion
        const url = element.dataset.url;
        window.location.href = url;
    }
}

function deleteModule(element) {
    if (confirm("Are you sure you want to delete this module?")) {
        // redirect to backend for deletion
        const url = element.dataset.url;
        window.location.href = url;
    }
}
