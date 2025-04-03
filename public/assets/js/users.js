//tailwind config
tailwind.config = {
    theme: {
        extend: {
            colors: {
                'primary': '#4A5568',
                'secondary': '#718096',
                'background': '#F7FAFC',
                'accent-light': '#E2E8F0',
                'accent-dark': '#2D3748',
                'fine-color': '#A1DBF1'
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-out',
                'slide-in-left': 'slideInLeft 0.5s ease-out',
                'pulse-slow': 'pulse 2s infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideInLeft: {
                    '0%': { transform: 'translateX(-100%)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' },
                }
            }
        }
    }
}


/// ======================
// DOM Elements
// ======================
const userList = document.getElementById('userList');
const refreshBtn = document.getElementById('refreshUsers');
const loadingIndicator = document.getElementById('loadingIndicator');
const emptyState = document.getElementById('emptyState');

// ======================
// Initialization
// ======================
document.addEventListener('DOMContentLoaded', initializePage);

function initializePage() {
    loadActiveUsers();
    refreshBtn.addEventListener('click', loadActiveUsers);
}

// ======================
// Main Functions
// ======================
async function loadActiveUsers() {
    try {
        setLoadingState(true);
        const activeUsers = await fetchActiveUsers();
        renderActiveUsers(activeUsers);
    } catch (error) {
        handleLoadingError(error);
    } finally {
        setLoadingState(false);
    }
}

async function fetchActiveUsers() {
    const response = await fetch('/api/active-users');
    if (!response.ok) throw new Error('Failed to fetch active users');
    return await response.json();
}

function renderActiveUsers(users) {
    if (users.length === 0) {
        showEmptyState();
        return;
    }

    hideEmptyState();
    userList.innerHTML = generateUserCards(users);
}

// ======================
// UI Helper Functions
// ======================
function generateUserCards(users) {
    return users.map(user => `
        <div class="grid grid-cols-12 gap-4 p-4 border-b border-gray-200 hover:bg-gray-50 transition-colors">
            <div class="col-span-4 flex items-center">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden mr-3">
                    ${user.avatar ?
                        `<img src="${user.avatar}" alt="${user.name}" class="w-full h-full object-cover">` :
                        `<span class="text-gray-600 font-medium">${user.name.charAt(0).toUpperCase()}</span>`
                    }
                </div>
                <div>
                    <h3 class="font-medium text-gray-800">${user.name}</h3>
                    <p class="text-sm text-gray-500">${user.role}</p>
                </div>
            </div>
            <div class="col-span-3 flex items-center text-gray-700">${user.email}</div>
            <div class="col-span-2 flex items-center">
                <span class="${getRoleBadgeClasses(user.role)} px-2 py-1 rounded-full text-xs capitalize">
                    ${user.role}
                </span>
            </div>
            <div class="col-span-2 flex items-center text-sm text-gray-600">
                ${formatTimeSince(user.login_at)}
            </div>
            <div class="col-span-1 flex items-center">
                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                    Active
                </span>
            </div>
        </div>
    `).join('');
}

function setLoadingState(isLoading) {
    refreshBtn.disabled = isLoading;
    if (isLoading) {
        showLoading();
    } else {
        hideLoading();
    }
}

function showLoading() {
    loadingIndicator.classList.remove('hidden');
    userList.innerHTML = '';
    emptyState.classList.add('hidden');
}

function hideLoading() {
    loadingIndicator.classList.add('hidden');
}

function showEmptyState() {
    userList.innerHTML = '';
    emptyState.classList.remove('hidden');
}

function hideEmptyState() {
    emptyState.classList.add('hidden');
}

function handleLoadingError(error) {
    console.error('Error loading active users:', error);
    userList.innerHTML = '';
    emptyState.classList.remove('hidden');
    emptyState.querySelector('h3').textContent = 'Error loading users';
    emptyState.querySelector('p').textContent = 'Failed to fetch active users. Please try again.';
}

// ======================
// Utility Functions
// ======================
function formatTimeSince(timestamp) {
    const now = new Date();
    const loginTime = new Date(timestamp);
    const diffInMinutes = Math.floor((now - loginTime) / (1000 * 60));

    if (diffInMinutes < 1) return 'Just now';
    if (diffInMinutes < 60) return `${diffInMinutes} min ago`;

    const diffInHours = Math.floor(diffInMinutes / 60);
    if (diffInHours < 24) return `${diffInHours} hour${diffInHours > 1 ? 's' : ''} ago`;

    const diffInDays = Math.floor(diffInHours / 24);
    return `${diffInDays} day${diffInDays > 1 ? 's' : ''} ago`;
}

function getRoleBadgeClasses(role) {
    const roleClasses = {
        'admin': 'bg-purple-100 text-purple-800',
        'instructor': 'bg-blue-100 text-blue-800',
        'learner': 'bg-green-100 text-green-800'
    };
    return roleClasses[role.toLowerCase()] || 'bg-gray-100 text-gray-800';
}
