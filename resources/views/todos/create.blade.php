<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Task - Idul Adha Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8B4513',      // Saddle Brown
                        secondary: '#D2691E',    // Chocolate
                        accent: '#DAA520',       // Goldenrod
                        gold: '#FFD700',         // Gold
                        cream: '#F5F5DC',        // Beige
                        darkBrown: '#654321',    // Dark Brown
                        lightGold: '#FFF8DC',    // Cornsilk
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-lightGold via-cream to-gold min-h-screen font-poppins">
    <!-- Header with Islamic Pattern -->
    <header class="relative bg-gradient-to-r from-primary via-secondary to-darkBrown shadow-2xl border-b-4 border-gold overflow-hidden">
        <!-- Islamic Pattern Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="islamic-pattern"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-gold hover:text-cream mr-6 p-2 rounded-xl hover:bg-white hover:bg-opacity-20 transition duration-300 transform hover:scale-110">
                        <i class="fas fa-arrow-left text-2xl"></i>
                    </a>
                    <div class="relative">
                        <i class="fas fa-mosque text-gold text-3xl mr-4 animate-pulse"></i>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-gold rounded-full animate-ping"></div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gold font-poppins tracking-wide">
                            @if(isset($duplicateTask))
                                Duplicate Task
                            @else
                                Add New Task
                            @endif
                        </h1>
                        <p class="text-sm text-cream opacity-90">Create with Barakah</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-right">
                        <span class="text-cream text-sm block">Barakallahu feeki</span>
                        <span class="text-gold font-semibold">{{ Auth::user()->name }}</span>
                    </div>
                    <a href="{{ route('logout') }}" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-3 rounded-xl transition duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Bismillah Card -->
        <div class="mb-8 bg-gradient-to-r from-primary to-secondary rounded-3xl p-6 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gold opacity-20 rounded-full -mr-16 -mt-16"></div>
            <div class="relative z-10 text-center">
                <h2 class="text-2xl font-bold mb-2">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم</h2>
                <p class="text-lg opacity-90">In the name of Allah, the Most Gracious, the Most Merciful</p>
                <p class="text-sm opacity-75 mt-2">Start your task with Allah's blessing</p>
            </div>
        </div>

        <!-- Breadcrumb with Islamic Touch -->
        <nav class="flex mb-8 bg-white rounded-2xl p-4 shadow-lg border-l-4 border-primary" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-primary hover:text-secondary transition duration-300">
                        <i class="fas fa-mosque mr-2"></i>Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-accent mx-2"></i>
                        <span class="text-sm font-medium text-gray-600">
                            @if(isset($duplicateTask))
                                Duplicate Task
                            @else
                                Add Task
                            @endif
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        @if(isset($duplicateTask))
            <!-- Duplicate Notice with Islamic Design -->
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 rounded-2xl p-6 mb-8 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full mr-4">
                        <i class="fas fa-copy text-blue-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900 mb-1">Duplicating Task with Barakah</h3>
                        <p class="text-blue-700">Creating a blessed copy of: <strong>{{ $duplicateTask->title }}</strong></p>
                        <p class="text-sm text-blue-600 mt-1">You can modify the details below before saving, InshaAllah.</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Form Card -->
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-primary to-secondary p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">
                            @if(isset($duplicateTask))
                                Duplicate Task Details
                            @else
                                Create New Task
                            @endif
                        </h2>
                        <p class="text-cream opacity-90">Fill in the details below to create a blessed task.</p>
                    </div>
                    <div class="text-6xl opacity-30">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form action="{{ route('todos.store') }}" method="POST" class="space-y-8" id="createForm">
                    @csrf

                    <!-- Title Field -->
                    <div class="group">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-heading mr-2 text-primary"></i>Task Title *
                            <span class="text-xs text-gray-500 ml-2">(What needs to be accomplished?)</span>
                        </label>
                        <div class="relative">
                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', isset($duplicateTask) ? $duplicateTask->title : '') }}"
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary transition duration-300 text-lg @error('title') border-red-500 @enderror"
                                   placeholder="Enter your blessed task title..."
                                   required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                                <i class="fas fa-pen text-gray-400 group-focus-within:text-primary transition duration-300"></i>
                            </div>
                        </div>
                        @error('title')
                            <p class="mt-3 text-sm text-red-600 flex items-center bg-red-50 p-3 rounded-xl">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div class="group">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-align-left mr-2 text-primary"></i>Description
                            <span class="text-xs text-gray-500 ml-2">(Add more details about your task)</span>
                        </label>
                        <div class="relative">
                            <textarea id="description"
                                      name="description"
                                      rows="5"
                                      class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary transition duration-300 text-lg resize-none @error('description') border-red-500 @enderror"
                                      placeholder="Describe your task in detail... May Allah make it easy for you.">{{ old('description', isset($duplicateTask) ? $duplicateTask->description : '') }}</textarea>
                            <div class="absolute top-4 right-6">
                                <i class="fas fa-comment text-gray-400 group-focus-within:text-primary transition duration-300"></i>
                            </div>
                        </div>
                        @error('description')
                            <p class="mt-3 text-sm text-red-600 flex items-center bg-red-50 p-3 rounded-xl">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Deadline Field -->
                    <div class="group">
                        <label for="deadline" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-calendar-alt mr-2 text-primary"></i>Deadline
                            <span class="text-xs text-gray-500 ml-2">(When should this be completed?)</span>
                        </label>
                        <div class="relative">
                            <input type="date"
                                   id="deadline"
                                   name="deadline"
                                   value="{{ old('deadline', isset($duplicateTask) && $duplicateTask->deadline ? \Carbon\Carbon::parse($duplicateTask->deadline)->format('Y-m-d') : '') }}"
                                   min="{{ date('Y-m-d') }}"
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary transition duration-300 text-lg @error('deadline') border-red-500 @enderror">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                                <i class="fas fa-clock text-gray-400 group-focus-within:text-primary transition duration-300"></i>
                            </div>
                        </div>
                        @error('deadline')
                            <p class="mt-3 text-sm text-red-600 flex items-center bg-red-50 p-3 rounded-xl">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                        @enderror
                        <div class="mt-3 p-4 bg-gradient-to-r from-lightGold to-cream rounded-xl border border-accent">
                            <p class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-lightbulb mr-2 text-accent"></i>
                                Leave empty if no specific deadline. Tasks with deadlines will be prioritized by Allah's will.
                            </p>
                        </div>
                    </div>

                    <!-- Deadline Priority Preview -->
                    <div id="deadlinePreview" class="hidden bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-6 border-l-4 border-primary">
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-eye mr-2 text-primary"></i>Deadline Priority Preview
                        </h4>
                        <div id="priorityIndicator" class="text-sm"></div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-8 border-t-2 border-gray-100">
                        <a href="{{ route('home') }}" class="bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 px-8 py-4 rounded-2xl font-semibold transition duration-300 transform hover:scale-105 flex items-center shadow-lg">
                            <i class="fas fa-times mr-3"></i>Cancel
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white px-10 py-4 rounded-2xl font-semibold transition duration-300 transform hover:scale-105 flex items-center shadow-xl">
                            <i class="fas fa-plus mr-3"></i>
                            @
                            @if(isset($duplicateTask))
                                Create Duplicate with Barakah
                            @else
                                Create Task with Barakah
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Islamic Tips Card -->
        <div class="mt-8 bg-gradient-to-r from-accent to-gold rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-10 rounded-full -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-white opacity-10 rounded-full -ml-16 -mb-16"></div>

            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-6 flex items-center">
                    <i class="fas fa-lightbulb mr-3"></i>Tips for Blessed Task Management
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-start bg-white bg-opacity-20 rounded-xl p-4 backdrop-blur-sm">
                            <i class="fas fa-star text-gold mr-3 mt-1 text-lg"></i>
                            <span>Start with Bismillah and clear intentions</span>
                        </div>
                        <div class="flex items-start bg-white bg-opacity-20 rounded-xl p-4 backdrop-blur-sm">
                            <i class="fas fa-heart text-gold mr-3 mt-1 text-lg"></i>
                            <span>Use specific and meaningful task titles</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start bg-white bg-opacity-20 rounded-xl p-4 backdrop-blur-sm">
                            <i class="fas fa-clock text-gold mr-3 mt-1 text-lg"></i>
                            <span>Set realistic deadlines with Allah's guidance</span>
                        </div>
                        <div class="flex items-start bg-white bg-opacity-20 rounded-xl p-4 backdrop-blur-sm">
                            <i class="fas fa-hands text-gold mr-3 mt-1 text-lg"></i>
                            <span>Make dua for success in your endeavors</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Islamic Quote -->
        <div class="mt-8 text-center">
            <div class="bg-white rounded-3xl shadow-xl p-8 max-w-2xl mx-auto border-t-4 border-primary">
                <i class="fas fa-quote-left text-primary text-3xl mb-4"></i>
                <p class="text-gray-700 italic text-xl mb-4 leading-relaxed">
                    "And whoever relies upon Allah - then He is sufficient for him. Indeed, Allah will accomplish His purpose."
                </p>
                <p class="text-primary font-bold text-lg">- At-Talaq 65:3</p>
                <div class="mt-6 flex justify-center space-x-3">
                    <span class="text-3xl">🕌</span>
                    <span class="text-3xl">✨</span>
                    <span class="text-3xl">🌙</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        /* Islamic Pattern Background */
        .islamic-pattern {
            background-image:
                radial-gradient(circle at 25% 25%, #FFD700 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, #DAA520 2px, transparent 2px);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
        }

        /* Enhanced animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* Custom focus effects */
        .group:focus-within label {
            color: #8B4513;
            transform: translateY(-2px);
        }

        /* Smooth transitions */
        * {
            transition: all 0.3s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: #F5F5DC;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #8B4513, #D2691E);
            border-radius: 10px;
            border: 2px solid #F5F5DC;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #654321, #8B4513);
        }

        /* Backdrop blur support */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        /* Enhanced form styling */
        input:focus, textarea:focus {
            box-shadow: 0 0 0 4px rgba(139, 69, 19, 0.1);
        }

        /* Button hover effects */
        button:hover, a:hover {
            box-shadow: 0 10px 25px rgba(139, 69, 19, 0.2);
        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bismillah notification
            setTimeout(() => {
                showIslamicNotification('Bismillah! Start creating your task with Allah\'s blessing 🌟', 'info');
            }, 1000);

            // Add floating animation to decorative elements
            const decorativeElements = document.querySelectorAll('.fas.fa-mosque');
            decorativeElements.forEach(element => {
                element.classList.add('animate-float');
            });
        });

        // Deadline priority preview
        document.getElementById('deadline').addEventListener('change', function() {
            const deadlineValue = this.value;
            const previewDiv = document.getElementById('deadlinePreview');
            const priorityIndicator = document.getElementById('priorityIndicator');

            if (deadlineValue) {
                const deadline = new Date(deadlineValue);
                const today = new Date();
                const diffTime = deadline - today;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                let priorityHTML = '';

                if (diffDays === 0) {
                    priorityHTML = `
                        <div class="flex items-center p-4 border-l-4 border-orange-500 bg-gradient-to-r from-orange-50 to-orange-100 rounded-xl">
                            <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-bold bg-orange-200 text-orange-800 mr-4">
                                <i class="fas fa-bell mr-2"></i>TODAY
                            </span>
                            <span class="text-gray-700 font-medium">This blessed task will be due today (high priority)</span>
                        </div>
                    `;
                } else if (diffDays === 1) {
                    priorityHTML = `
                        <div class="flex items-center p-4 border-l-4 border-yellow-500 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-xl">
                            <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-bold bg-yellow-200 text-yellow-800 mr-4">
                                <i class="fas fa-arrow-right mr-2"></i>TOMORROW
                            </span>
                            <span class="text-gray-700 font-medium">This task will be due tomorrow, InshaAllah</span>
                        </div>
                    `;
                } else if (diffDays <= 7) {
                    priorityHTML = `
                        <div class="flex items-center p-4 border-l-4 border-blue-500 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl">
                            <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-bold bg-blue-200 text-blue-800 mr-4">
                                <i class="fas fa-calendar-week mr-2"></i>THIS WEEK
                            </span>
                            <span class="text-gray-700 font-medium">This task will be due in ${diffDays} day${diffDays > 1 ? 's' : ''}, by Allah's will</span>
                        </div>
                    `;
                } else {
                    priorityHTML = `
                        <div class="flex items-center p-4 border-l-4 border-gray-500 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                            <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-bold bg-gray-200 text-gray-800 mr-4">
                                <i class="fas fa-calendar mr-2"></i>LATER
                            </span>
                            <span class="text-gray-700 font-medium">This task will be due in ${diffDays} days, InshaAllah</span>
                        </div>
                    `;
                }

                priorityIndicator.innerHTML = priorityHTML;
                previewDiv.classList.remove('hidden');
                previewDiv.style.animation = 'slideDown 0.5s ease-out';
            } else {
                previewDiv.classList.add('hidden');
            }
        });

        // Character counter for title
        const titleInput = document.getElementById('title');
        const titleLabel = titleInput.previousElementSibling;

        titleInput.addEventListener('input', function() {
            const remaining = 255 - this.value.length;
            const counter = titleLabel.querySelector('.char-counter') || document.createElement('span');
            counter.className = 'char-counter text-xs ml-2';
            counter.textContent = `(${remaining} characters remaining)`;

            if (remaining < 20) {
                counter.className = 'char-counter text-xs text-red-500 ml-2 font-semibold';
            } else {
                counter.className = 'char-counter text-xs text-gray-500 ml-2';
            }

            if (!titleLabel.querySelector('.char-counter')) {
                titleLabel.appendChild(counter);
            }
        });

        // Character counter for description
        const descInput = document.getElementById('description');
        const descLabel = descInput.previousElementSibling;

        descInput.addEventListener('input', function() {
            const remaining = 1000 - this.value.length;
            const counter = descLabel.querySelector('.char-counter') || document.createElement('span');
            counter.className = 'char-counter text-xs ml-2';
            counter.textContent = `(${remaining} characters remaining)`;

            if (remaining < 50) {
                counter.className = 'char-counter text-xs text-red-500 ml-2 font-semibold';
            } else {
                counter.className = 'char-counter text-xs text-gray-500 ml-2';
            }

            if (!descLabel.querySelector('.char-counter')) {
                descLabel.appendChild(counter);
            }
        });

        // Form validation with Islamic touch
        document.getElementById('createForm').addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            if (title.length < 3) {
                e.preventDefault();
                showIslamicNotification('SubhanAllah! Task title must be at least 3 characters long', 'warning');
                document.getElementById('title').focus();
                return false;
            }

            // Show success message
            showIslamicNotification('Bismillah! Creating your blessed task...', 'success');
        });

        // Islamic notification system
        function showIslamicNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'from-green-500 to-emerald-600' :
                           type === 'error' ? 'from-red-500 to-red-600' :
                           type === 'warning' ? 'from-yellow-500 to-orange-600' :
                           'from-blue-500 to-blue-600';

            notification.className = `fixed top-4 right-4 bg-gradient-to-r ${bgColor} text-white px-6 py-4 rounded-2xl shadow-2xl z-50 flex items-center transform translate-x-full transition-all duration-500 max-w-md`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-star' : type === 'error' ? 'fa-exclamation-triangle' : type === 'warning' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-3 text-xl"></i>
                    <div>
                        <div class="font-semibold">${message}</div>
                        <div class="text-sm opacity-90 mt-1">May Allah bless your efforts</div>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200 text-xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            document.body.appendChild(notification);

            // Slide in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 500);
            }, 5000);
        }

        // Auto-focus on title if duplicating
        @if(isset($duplicateTask))
            document.getElementById('title').focus();
            document.getElementById('title').select();
        @endif

        // Add slide down animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
