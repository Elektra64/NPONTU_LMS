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

// Function to view course details
function viewCourseDetails(element) {
    fetch(element.dataset.url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(
                    `Unexpected Error Occurred Status: ${response.status}`
                );
            }
            return response.json();
        })
        .then((data) => {
            const course = data.course;
            const questions = data.questions;
            console.log(course);
            document.getElementById("courseDetailsContent").innerHTML =
                setCourseDetails(course, questions);
        })
        .catch((error) => {
            console.error("Error:", error); // Handle error
        });

    // Show the modal
    document.getElementById("courseDetailsModal").classList.remove("hidden");
    document.body.style.overflow = "hidden";
}

// Close modal function
function closeDetailsModal() {
    document.getElementById("courseDetailsModal").classList.add("hidden");
    document.body.style.overflow = "";
}

// Initialize the dashboard
document.addEventListener("DOMContentLoaded", function () {
    // Close modal when clicking outside content
    document
        .getElementById("courseDetailsModal")
        .addEventListener("click", function (e) {
            if (e.target === this) {
                closeDetailsModal();
            }
        });
});

// Show notification
function showNotification(message) {
    const notification = document.createElement("div");
    notification.className =
        "fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg animate-fade-in";
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.classList.remove("animate-fade-in");
        notification.classList.add("animate-fade-out");
        setTimeout(() => notification.remove(), 500);
    }, 3000);
}

function setCourseDetails(course, questions) {
    let modulesHtml;
    if (course.modules.length > 0) {
        modulesHtml = course.modules
            .map(
                (module, index) => `
            <div class="mb-6 border-b pb-4">
                <h3 class="text-xl font-semibold mb-2">${module.title}</h3>
                <div class="flex items-center text-sm text-gray-600 mb-3">
                    <span class="mr-4">Module Number: ${
                        module.module_number
                    }</span>
                </div>
                <p class="text-gray-700 mb-4">${module.content}</p>

                ${
                    questions.length > 0
                        ? `
                    ${questions
                        .map((question, qIndex) =>
                            question.module_id == module.id
                                ? `
                                 <h4 class="font-medium mb-2">Quiz Questions:</h4>
                <div class="space-y-3">
                             <div class="bg-gray-50 p-3 rounded">
                        <p class="font-medium">Question ${qIndex + 1}: ${
                                      question.question_text
                                  }</p>
                        <div class="mt-2">
                            
                            <div class="flex flex-col justify-center space-y-2">
                                <span class="${checkAndStyle(
                                    "a",
                                    question.option.correct_option
                                )}">A. ${question.option.option_a}</span>
                                <span class="${checkAndStyle(
                                    "b",
                                    question.option.correct_answer
                                )}">B. ${question.option.option_b}</span>
                                <span class="${checkAndStyle(
                                    "c",
                                    question.option.correct_option
                                )}">C. ${question.option.option_c}</span>
                                <span class="${checkAndStyle(
                                    "d",
                                    question.option.correct_option
                                )}">D. ${question.option.option_d}</span>
                               
                            </div>
                            
                        </div>
                    </div>
                   
                    `
                                : '<p class="text-gray-500">No quiz questions for this module</p>'
                        )
                        .join("")}
                </div>
                `
                        : ""
                }
            </div>
        `
            )
            .join("");
    }

    const courseDetailsHtml = `
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Course Overview</h3>
            <p class="text-gray-700 mb-4">${course.description}</p>
            <div class="grid md:grid-cols-3 gap-4 mb-4">
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm text-gray-500">Category</p>
                    <p class="font-medium">${
                        course.categories[0].category_name
                    }</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm text-gray-500">Difficulty</p>
                    <p class="font-medium">${course.difficulty_level}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm text-gray-500">Enrollments</p>
                    <p class="font-medium">100 enrollments</p>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm text-gray-500">Duration</p>
                    <p class="font-medium">${course.duration} weeks (${
        course.credit_hours
    } hrs/week)</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm text-gray-500">Final Exam</p>
                    <p class="font-medium">Weight: ${
                        course.final_exam_weight
                    }%</p>
                </div>
            </div>
        </div>

        <h3 class="text-xl font-semibold mb-4">Course Modules</h3>
        ${modulesHtml}

        ${
            course.video_url
                ? `
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2">Course Preview</h3>
            <div class="aspect-w-16 aspect-h-9 bg-black rounded overflow-hidden">
                <iframe src="${course.video_url}" class="w-full h-64" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        `
                : ""
        }
    `;

    return courseDetailsHtml;
}

function checkAndStyle(option, correct_option) {
    let style;
    switch (option) {
        case "a":
            style =
                option === correct_option ? "text-green-600 font-medium" : "";
            break;
        case "b":
            style =
                option === correct_option ? "text-green-600 font-medium" : "";
            break;
        case "c":
            style =
                option === correct_option ? "text-green-600 font-medium" : "";
            break;
        case "d":
            style =
                option === correct_option ? "text-green-600 font-medium" : "";
    }
    return style;
}
