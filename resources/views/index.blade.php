<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List - Idul Adha Edition</title>
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
                    <!-- Mosque Icon with Animation -->
                    <div class="relative">
                        <i class="fas fa-mosque text-gold text-3xl mr-4 animate-pulse"></i>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-gold rounded-full animate-ping"></div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gold font-poppins tracking-wide">
                            Todo List
                        </h1>
                        <p class="text-sm text-cream opacity-90">Idul Adha Edition</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <!-- Greeting with Islamic Touch -->
                    <div class="text-right">
                        <span class="text-cream text-sm block">Assalamu'alaikum</span>
                        <span class="text-gold font-semibold">{{ Auth::user()->name }}</span>
                    </div>
                    <a href="{{ route('logout') }}" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-3 rounded-xl transition duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Idul Adha Greeting Card -->
        <div class="mb-8 bg-gradient-to-r from-primary to-secondary rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gold opacity-20 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-accent opacity-20 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">🕌 Idul Adha Mubarak! 🐐</h2>
                        <p class="text-lg opacity-90">Taqabbalallahu minna wa minkum</p>
                        <p class="text-sm opacity-75 mt-1">May Allah accept our good deeds and yours</p>
                    </div>
                    <div class="text-6xl opacity-30">
                        <i class="fas fa-moon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-100 to-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl mb-6 flex items-center shadow-lg">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Enhanced Stats Cards with Islamic Theme -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-xl p-6 border-l-4 border-primary transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Tasks</p>
                        <p class="text-3xl font-bold text-primary">{{ $stats['total'] }}</p>
                    </div>
                    <div class="p-4 rounded-full bg-gradient-to-br from-primary to-secondary text-white">
                        <i class="fas fa-list text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-500">
                    <i class="fas fa-tasks mr-1"></i>
                    <span>All your tasks</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-6 border-l-4 border-green-500 transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Completed</p>
                        <p class="text-3xl font-bold text-green-600">{{ $stats['completed'] }}</p>
                    </div>
                    <div class="p-4 rounded-full bg-gradient-to-br from-green-500 to-green-600 text-white">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-500">
                    <i class="fas fa-trophy mr-1"></i>
                    <span>Well done!</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-6 border-l-4 border-accent transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Pending</p>
                        <p class="text-3xl font-bold text-accent">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="p-4 rounded-full bg-gradient-to-br from-accent to-gold text-white">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-500">
                    <i class="fas fa-hourglass-half mr-1"></i>
                    <span>In progress</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-6 border-l-4 border-red-500 transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Overdue</p>
                        <p class="text-3xl font-bold text-red-600">{{ $stats['late'] }}</p>
                    </div>
                    <div class="p-4 rounded-full bg-gradient-to-br from-red-500 to-red-600 text-white">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-500">
                    <i class="fas fa-fire mr-1"></i>
                    <span>Needs attention</span>
                </div>
            </div>
        </div>

        <!-- Header Actions with Enhanced Design -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-primary mb-2">My Tasks</h2>
                <p class="text-gray-600">Organize your tasks with barakah</p>
            </div>
            <a href="{{ route('todos.create') }}" class="bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white px-8 py-4 rounded-2xl font-semibold transition duration-300 transform hover:scale-105 shadow-xl flex items-center">
                <i class="fas fa-plus mr-3"></i>Add New Task
            </a>
        </div>

        <!-- Enhanced Todo List -->
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
            @if($todos->count() > 0)
                @php
                    $incompleteTodos = $todos->where('status', '!=', 'completed');
                    $completedTodos = $todos->where('status', 'completed');
                @endphp

                <div class="divide-y divide-gray-100">
                    <!-- Active Tasks Section -->
                    @if($incompleteTodos->count() > 0)
                        @foreach($incompleteTodos as $todo)
                            <div class="p-8 hover:bg-gradient-to-r hover:from-lightGold hover:to-cream transition duration-300 group">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-start space-x-6 flex-1">
                                        <!-- Enhanced Status Toggle -->
                                        <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-3xl transition duration-300 hover:scale-125 transform">
                                                <i class="far fa-circle text-gray-400 hover:text-primary group-hover:text-secondary"></i>
                                            </button>
                                        </form>

                                        <!-- Enhanced Todo Content -->
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-primary transition duration-300">
                                                {{ $todo->title }}
                                            </h3>

                                            @if($todo->description)
                                                <p class="text-gray-600 mb-4 leading-relaxed">
                                                    {{ $todo->description }}
                                                </p>
                                            @endif

                                            <div class="flex items-center space-x-6">
                                                <!-- Enhanced Status Badge -->
                                                @if($todo->status === 'late')
                                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-red-100 to-red-50 text-red-800 border border-red-200">
                                                        <i class="fas fa-fire mr-2"></i>Overdue
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-accent to-gold text-white">
                                                        <i class="fas fa-clock mr-2"></i>Pending
                                                    </span>
                                                @endif

                                                <!-- Enhanced Deadline -->
                                                @if($todo->deadline)
                                                    <span class="text-sm text-gray-500 flex items-center bg-gray-50 px-3 py-1 rounded-full">
                                                        <i class="fas fa-calendar-alt mr-2"></i>
                                                        {{ format_date($todo->deadline, 'M d, Y') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Enhanced Actions -->
                                    <div class="flex items-center space-x-3 ml-6">
                                        <a href="{{ route('todos.edit', $todo) }}"
                                           class="text-primary hover:text-secondary p-3 rounded-xl hover:bg-primary hover:bg-opacity-10 transition duration-300 transform hover:scale-110"
                                           title="Edit task">
                                            <i class="fas fa-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 p-3 rounded-xl hover:bg-red-50 transition duration-300 transform hover:scale-110">
                                                <i class="fas fa-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <!-- Enhanced Completed Tasks Section -->
                    @if($completedTodos->count() > 0)
                        @if($incompleteTodos->count() > 0)
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-8 py-4 border-t-2
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-8 py-4 border-t-2 border-green-200">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-bold text-green-800 flex items-center">
                                        <i class="fas fa-check-circle text-green-600 mr-3 text-xl"></i>
                                        Completed Tasks ({{ $completedTodos->count() }})
                                        <span class="ml-3 text-sm bg-green-200 text-green-800 px-3 py-1 rounded-full">Alhamdulillah</span>
                                    </h3>
                                    <button onclick="toggleCompletedTasks()" id="toggleCompletedBtn" class="text-sm text-green-700 hover:text-green-900 flex items-center bg-green-100 hover:bg-green-200 px-4 py-2 rounded-full transition duration-300">
                                        <span id="toggleText">Hide</span>
                                        <i id="toggleIcon" class="fas fa-chevron-up ml-2"></i>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <div id="completedTasksContainer" class="{{ $incompleteTodos->count() > 0 ? '' : '' }}">
                            @foreach($completedTodos as $todo)
                                <div class="p-8 hover:bg-green-50 transition duration-300 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start space-x-6 flex-1">
                                            <!-- Completed Status -->
                                            <div class="mt-2">
                                                <i class="fas fa-check-circle text-green-600 text-3xl"></i>
                                            </div>

                                            <!-- Completed Todo Content -->
                                            <div class="flex-1">
                                                <h3 class="text-xl font-bold text-gray-700 line-through mb-2 flex items-center">
                                                    {{ $todo->title }}
                                                    <span class="ml-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-200 text-green-800">
                                                        <i class="fas fa-star mr-1"></i>Completed
                                                    </span>
                                                </h3>

                                                @if($todo->description)
                                                    <p class="text-gray-500 mb-4 line-through leading-relaxed">
                                                        {{ $todo->description }}
                                                    </p>
                                                @endif

                                                <div class="flex items-center space-x-6">
                                                    <!-- Completed Badge -->
                                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-green-500 to-emerald-600 text-white">
                                                        <i class="fas fa-trophy mr-2"></i>Done
                                                    </span>

                                                    <!-- Original Deadline -->
                                                    @if($todo->deadline)
                                                        <span class="text-sm text-gray-500 flex items-center bg-gray-100 px-3 py-1 rounded-full">
                                                            <i class="fas fa-calendar-alt mr-2"></i>
                                                            Due: {{ format_date($todo->deadline, 'M d, Y') }}
                                                        </span>
                                                    @endif

                                                    <!-- Completion Date -->
                                                    @if($todo->completed_at)
                                                        <span class="text-sm text-green-700 flex items-center bg-green-100 px-3 py-1 rounded-full font-medium">
                                                            <i class="fas fa-check mr-2"></i>
                                                            Completed {{ format_date($todo->completed_at, 'M d, Y') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Completed Task Actions -->
                                        <div class="flex items-center space-x-3 ml-6">
                                            <!-- Reopen Task Button -->
                                            <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="text-blue-600 hover:text-blue-800 p-3 rounded-xl hover:bg-blue-50 transition duration-300 transform hover:scale-110"
                                                        title="Reopen task">
                                                    <i class="fas fa-undo text-lg"></i>
                                                </button>
                                            </form>

                                            <!-- Delete Button -->
                                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this completed task?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 p-3 rounded-xl hover:bg-red-50 transition duration-300 transform hover:scale-110">
                                                    <i class="fas fa-trash text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Completion Celebration -->
                                    <div class="mt-6 p-4 bg-gradient-to-r from-green-100 to-emerald-100 border border-green-300 rounded-xl">
                                        <div class="flex items-center text-sm text-green-800">
                                            <i class="fas fa-star mr-2 text-gold"></i>
                                            <span class="font-medium">Barakallahu feeki! Task completed successfully. May Allah reward your efforts.</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @else
                <!-- Enhanced Empty State -->
                <div class="text-center py-20">
                    <div class="mb-8">
                        <i class="fas fa-mosque text-primary text-8xl mb-4 opacity-50"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-primary mb-4">No tasks yet</h3>
                    <p class="text-gray-600 mb-2">Start your productive journey with barakah</p>
                    <p class="text-sm text-gray-500 mb-8 italic">"And whoever relies upon Allah - then He is sufficient for him"</p>
                    <a href="{{ route('todos.create') }}" class="bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white px-8 py-4 rounded-2xl font-semibold transition duration-300 transform hover:scale-105 shadow-xl inline-flex items-center">
                        <i class="fas fa-plus mr-3"></i>Create Your First Task
                    </a>
                </div>
            @endif
        </div>

        <!-- Enhanced Progress Summary -->
        @if($todos->count() > 0)
            <div class="mt-8 bg-gradient-to-r from-primary via-secondary to-darkBrown rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-gold opacity-10 rounded-full -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-accent opacity-10 rounded-full -ml-16 -mb-16"></div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-bold mb-2 flex items-center">
                                <i class="fas fa-chart-line mr-3"></i>
                                Your Progress
                            </h3>
                            <p class="text-cream opacity-90">
                                Alhamdulillah! You have completed {{ $stats['completed'] }} out of {{ $stats['total'] }} tasks
                                @if($stats['total'] > 0)
                                    ({{ round(($stats['completed'] / $stats['total']) * 100) }}%)
                                @endif
                            </p>
                        </div>
                        <div class="text-right space-y-3">
                            @if($stats['late'] > 0)
                                <div class="bg-red-500 bg-opacity-30 backdrop-blur-sm px-4 py-3 rounded-xl border border-red-400">
                                    <span class="text-sm font-semibold flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        {{ $stats['late'] }} overdue task{{ $stats['late'] > 1 ? 's' : '' }}
                                    </span>
                                </div>
                            @endif
                            @if($stats['pending'] > 0)
                                <div class="bg-accent bg-opacity-30 backdrop-blur-sm px-4 py-3 rounded-xl border border-accent">
                                    <span class="text-sm font-semibold flex items-center">
                                        <i class="fas fa-clock mr-2"></i>
                                        {{ $stats['pending'] }} pending task{{ $stats['pending'] > 1 ? 's' : '' }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Enhanced Progress Bar -->
                    @if($stats['total'] > 0)
                        <div class="space-y-4">
                            <div class="flex justify-between text-sm text-cream mb-2">
                                <span class="font-medium">Overall Progress</span>
                                <span class="font-bold">{{ round(($stats['completed'] / $stats['total']) * 100) }}%</span>
                            </div>
                            <div class="w-full bg-white bg-opacity-20 rounded-full h-4 overflow-hidden">
                                <div class="bg-gradient-to-r from-gold to-accent h-4 rounded-full transition-all duration-1000 ease-out shadow-lg"
                                     style="width: {{ ($stats['completed'] / $stats['total']) * 100 }}%"></div>
                            </div>

                            <!-- Motivational Quote -->
                            <div class="mt-6 text-center">
                                <p class="text-cream opacity-80 italic text-sm">
                                    "And give good tidings to those who believe and do righteous deeds"
                                </p>
                                <p class="text-gold text-xs mt-1">- Al-Baqarah 2:25</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Islamic Footer Quote -->
        <div class="mt-12 text-center">
            <div class="bg-white rounded-2xl shadow-lg p-6 max-w-2xl mx-auto border-t-4 border-primary">
                <i class="fas fa-quote-left text-primary text-2xl mb-4"></i>
                <p class="text-gray-700 italic text-lg mb-3">
                    "Whoever does righteous deeds, whether male or female, while being a believer, We will surely cause them to live a good life"
                </p>
                <p class="text-primary font-semibold">- An-Nahl 16:97</p>
                <div class="mt-4 flex justify-center space-x-2">
                    <span class="text-gold text-xl">🕌</span>
                    <span class="text-gold text-xl">✨</span>
                    <span class="text-gold text-xl">🌙</span>
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
            height: 100%;
            width: 100%;
        }

        /* Enhanced animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        /* Gradient text effect */
        .gradient-text {
            background: linear-gradient(45deg, #8B4513, #DAA520, #FFD700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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

        /* Hover effects */
        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(139, 69, 19, 0.1);
        }

        /* Islamic geometric patterns */
        .geometric-pattern {
            background-image:
                linear-gradient(45deg, transparent 40%, #DAA520 40%, #DAA520 60%, transparent 60%),
                linear-gradient(-45deg, transparent 40%, #FFD700 40%, #FFD700 60%, transparent 60%);
            background-size: 20px 20px;
            opacity: 0.1;
        }

        /* Glowing effect for important elements */
        .glow {
            box-shadow: 0 0 20px rgba(218, 165, 32, 0.3);
        }

        /* Smooth transitions */
        * {
            transition: all 0.3s ease;
        }

        /* Enhanced button styles */
        .btn-islamic {
            background: linear-gradient(45deg, #8B4513, #
        /* Enhanced button styles */
        .btn-islamic {
            background: linear-gradient(45deg, #8B4513, #D2691E);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
        }

        .btn-islamic:hover {
            background: linear-gradient(45deg, #D2691E, #DAA520);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 69, 19, 0.4);
        }

        /* Card hover animations */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(139, 69, 19, 0.15);
        }

        /* Progress bar animation */
        @keyframes progressFill {
            from { width: 0%; }
            to { width: var(--progress-width); }
        }

        .progress-animated {
            animation: progressFill 2s ease-out;
        }

        /* Floating elements */
        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .floating:nth-child(2) {
            animation-delay: 2s;
        }

        .floating:nth-child(3) {
            animation-delay: 4s;
        }

        /* Islamic calligraphy style borders */
        .islamic-border {
            border-image: linear-gradient(45deg, #8B4513, #DAA520, #FFD700, #DAA520, #8B4513) 1;
            border-width: 3px;
            border-style: solid;
        }

        /* Backdrop blur effect */
        .backdrop-blur {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Text shadow for better readability */
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Pulse animation for notifications */
        @keyframes pulse-gold {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(255, 215, 0, 0.7);
            }
            50% {
                box-shadow: 0 0 0 20px rgba(255, 215, 0, 0);
            }
        }

        .pulse-gold {
            animation: pulse-gold 2s infinite;
        }

        /* Gradient borders */
        .gradient-border {
            border: 3px solid;
            border-image: linear-gradient(45deg, #8B4513, #DAA520, #FFD700) 1;
        }

        /* Enhanced shadows */
        .shadow-islamic {
            box-shadow:
                0 4px 6px rgba(139, 69, 19, 0.1),
                0 1px 3px rgba(139, 69, 19, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        /* Responsive text sizing */
        @media (max-width: 768px) {
            .responsive-text {
                font-size: 0.875rem;
            }
        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        // Enhanced functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide success messages with animation
            const successAlert = document.querySelector('.bg-gradient-to-r.from-green-100');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.transform = 'translateX(100%)';
                    successAlert.style.opacity = '0';
                    setTimeout(() => {
                        successAlert.remove();
                    }, 500);
                }, 5000);
            }

            // Add floating animation to decorative elements
            const decorativeElements = document.querySelectorAll('.fas.fa-moon, .fas.fa-mosque');
            decorativeElements.forEach((element, index) => {
                element.classList.add('floating');
                element.style.animationDelay = `${index * 2}s`;
            });

            // Enhanced progress bar animation
            const progressBar = document.querySelector('.bg-gradient-to-r.from-gold.to-accent');
            if (progressBar) {
                const targetWidth = progressBar.style.width;
                progressBar.style.width = '0%';
                setTimeout(() => {
                    progressBar.style.width = targetWidth;
                    progressBar.classList.add('progress-animated');
                }, 1000);
            }

            // Add hover effects to task cards
            const taskCards = document.querySelectorAll('.p-8.hover\\:bg-gradient-to-r');
            taskCards.forEach(card => {
                card.classList.add('card-hover');

                card.addEventListener('mouseenter', function() {
                    this.style.background = 'linear-gradient(to right, #FFF8DC, #F5F5DC)';
                    this.style.borderLeft = '4px solid #DAA520';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.background = '';
                    this.style.borderLeft = '';
                });
            });

            // Islamic time-based greetings
            updateIslamicGreeting();

            // Add Islamic patterns to background
            createIslamicPatterns();

            // Animate stats cards on scroll
            animateStatsOnScroll();
        });

        // Toggle completed tasks with enhanced animation
        function toggleCompletedTasks() {
            const container = document.getElementById('completedTasksContainer');
            const toggleBtn = document.getElementById('toggleCompletedBtn');
            const toggleText = document.getElementById('toggleText');
            const toggleIcon = document.getElementById('toggleIcon');

            if (container.style.display === 'none' || container.style.maxHeight === '0px') {
                // Show completed tasks
                container.style.display = 'block';
                container.style.maxHeight = '2000px';
                container.style.opacity = '1';
                toggleText.textContent = 'Hide';
                toggleIcon.className = 'fas fa-chevron-up ml-2';
                localStorage.setItem('completedTasksVisible', 'true');

                // Add slide-down animation
                container.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    container.style.transform = 'translateY(0)';
                }, 100);
            } else {
                // Hide completed tasks
                container.style.transform = 'translateY(-20px)';
                container.style.opacity = '0';
                toggleText.textContent = 'Show';
                toggleIcon.className = 'fas fa-chevron-down ml-2';
                localStorage.setItem('completedTasksVisible', 'false');

                setTimeout(() => {
                    container.style.display = 'none';
                    container.style.maxHeight = '0px';
                }, 300);
            }
        }

        // Islamic greeting based on time
        function updateIslamicGreeting() {
            const hour = new Date().getHours();
            const greetingElement = document.querySelector('.text-cream.text-sm');

            if (greetingElement) {
                let greeting = 'Assalamu\'alaikum';

                if (hour >= 5 && hour < 12) {
                    greeting = 'Assalamu\'alaikum wa rahmatullahi wa barakatuh';
                } else if (hour >= 12 && hour < 15) {
                    greeting = 'Assalamu\'alaikum (Blessed afternoon)';
                } else if (hour >= 15 && hour < 18) {
                    greeting = 'Assalamu\'alaikum (Peaceful evening)';
                } else if (hour >= 18 && hour < 22) {
                    greeting = 'Assalamu\'alaikum (Blessed evening)';
                } else {
                    greeting = 'Assalamu\'alaikum (Peaceful night)';
                }

                greetingElement.textContent = greeting;
            }
        }

        // Create subtle Islamic geometric patterns
        function createIslamicPatterns() {
            const header = document.querySelector('header');
            if (header) {
                const pattern = document.createElement('div');
                pattern.className = 'absolute inset-0 geometric-pattern';
                header.appendChild(pattern);
            }
        }

        // Animate statistics cards on scroll
        function animateStatsOnScroll() {
            const statsCards = document.querySelectorAll('.grid.grid-cols-1.md\\:grid-cols-4 > div');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.transform = 'translateY(0) scale(1)';
                            entry.target.style.opacity = '1';
                        }, index * 200);
                    }
                });
            }, { threshold: 0.1 });

            statsCards.forEach(card => {
                card.style.transform = 'translateY(50px) scale(0.9)';
                card.style.opacity = '0';
                card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                observer.observe(card);
            });
        }

        // Enhanced form submission with Islamic blessing
        document.querySelectorAll('form[action*="toggle"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('button[type="submit"]');
                const taskElement = this.closest('.p-8');

                // Add completion blessing
                const isCompleting = button.querySelector('.far.fa-circle');
                if (isCompleting) {
                    // Show Islamic blessing notification
                    setTimeout(() => {
                        showIslamicNotification('Barakallahu feeki! Task completed with barakah! 🌟', 'success');
                    }, 500);
                }
            });
        });

        // Islamic notification system
        function showIslamicNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'from-green-500 to-emerald-600' :
                           type === 'error' ? 'from-red-500 to-red-600' : 'from-blue-500 to-blue-600';

            notification.className = `fixed top-4 right-4 bg-gradient-to-r ${bgColor} text-white px-6 py-4 rounded-2xl shadow-2xl z-50 flex items-center transform translate-x-full transition-all duration-500 max-w-md`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-star' : type === 'error' ? 'fa-exclamation-triangle' : 'fa-info-circle'} mr-3 text-xl"></i>
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

            // Auto remove after 6 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 500);
            }, 6000);
        }

        // Enhanced delete confirmation with Islamic touch
        document.querySelectorAll('form[action*="destroy"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const taskElement = this.closest('.p-8');
                const taskTitle = taskElement.querySelector('h3').textContent.trim();
                const isCompleted = taskElement.classList.contains('bg-gradient-to-r');

                const confirmMessage = `Bismillah. Are you sure you want to delete "${taskTitle}"?\n\nThis action cannot be undone. May Allah guide your decision.`;

                if (confirm(confirmMessage)) {
                    // Add deletion animation with Islamic blessing
                    taskElement.style.transition = 'all 0.5s ease-in-out';
                    taskElement.style.opacity = '0';
                    taskElement.style.transform = 'translateX(-30px) scale(0.95)';

                    showIslamicNotification('Task removed. Alhamdulillahi rabbil alameen.', 'info');

                    setTimeout(() => {
                        this.submit();
                    }, 500);
                }
            });
        });

        // Keyboard shortcuts with Islamic touch
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + N for new task
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                showIslamicNotification('Bismillah! Creating new task...', 'info');
                setTimeout(() => {
                    window.location.href = "{{ route('todos.create') }}";
                }, 1000);
            }

            // Ctrl/Cmd + H to toggle completed tasks
            if ((e.ctrlKey || e.metaKey) && e.key === 'h') {
                e.preventDefault();
                const toggleBtn = document.getElementById('toggleCompletedBtn');
                if (toggleBtn) {
                    toggleCompletedTasks();
                }
            }
        });

        // Restore completed tasks visibility state
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('completedTasksContainer');
            const toggleText = document.getElementById('toggleText');
            const toggleIcon = document.getElementById('toggleIcon');
            const isVisible = localStorage.getItem('completedTasksVisible');

            if (isVisible === 'false' && container) {
                container.style.display = 'none';
                container.style.maxHeight = '0px';
                toggleText.textContent = 'Show';
                toggleIcon.className = 'fas fa-chevron-down ml-2';
            }
        });

        // Add Islamic calendar date
        function addIslamicDate() {
            const islamicMonths = [
                'Muharram', 'Safar', 'Rabi\' al-awwal', 'Rabi\' al-thani',
                'Jumada al-awwal', 'Jumada al-thani', 'Rajab', 'Sha\'ban',
                'Ramadan',
        // Add Islamic calendar date
        function addIslamicDate() {
            const islamicMonths = [
                'Muharram', 'Safar', 'Rabi\' al-awwal', 'Rabi\' al-thani',
                'Jumada al-awwal', 'Jumada al-thani', 'Rajab', 'Sha\'ban',
                'Ramadan', 'Shawwal', 'Dhu al-Qi\'dah', 'Dhu al-Hijjah'
            ];

            // Simple approximation for Islamic date (for display purposes)
            const today = new Date();
            const islamicYear = 1445; // Approximate current Hijri year
            const monthIndex = Math.floor(Math.random() * 12); // Simplified for demo
            const day = Math.floor(Math.random() * 29) + 1;

            const islamicDateElement = document.createElement('div');
            islamicDateElement.className = 'text-xs text-cream opacity-75 mt-1';
            islamicDateElement.textContent = `${day} ${islamicMonths[monthIndex]} ${islamicYear} AH`;

            const headerTitle = document.querySelector('header h1').parentElement;
            if (headerTitle) {
                headerTitle.appendChild(islamicDateElement);
            }
        }

        // Prayer time reminder (simplified)
        function addPrayerTimeReminder() {
            const hour = new Date().getHours();
            let prayerMessage = '';

            if (hour >= 5 && hour < 6) {
                prayerMessage = '🕌 Fajr time - Start your day with blessings';
            } else if (hour >= 12 && hour < 13) {
                prayerMessage = '🕌 Dhuhr time - Take a blessed break';
            } else if (hour >= 15 && hour < 16) {
                prayerMessage = '🕌 Asr time - Afternoon prayers';
            } else if (hour >= 18 && hour < 19) {
                prayerMessage = '🕌 Maghrib time - Evening prayers';
            } else if (hour >= 20 && hour < 21) {
                prayerMessage = '🕌 Isha time - Night prayers';
            }

            if (prayerMessage) {
                setTimeout(() => {
                    showIslamicNotification(prayerMessage, 'info');
                }, 3000);
            }
        }

        // Initialize Islamic features
        setTimeout(() => {
            addIslamicDate();
            addPrayerTimeReminder();
        }, 2000);

        // Smooth scroll to sections
        function smoothScrollTo(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        // Add loading animation for page transitions
        function addLoadingAnimation() {
            const links = document.querySelectorAll('a[href*="todos"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!this.href.includes('#')) {
                        const loader = document.createElement('div');
                        loader.className = 'fixed inset-0 bg-primary bg-opacity-90 flex items-center justify-center z-50';
                        loader.innerHTML = `
                            <div class="text-center text-white">
                                <i class="fas fa-mosque text-6xl mb-4 animate-pulse"></i>
                                <p class="text-xl font-semibold">Bismillah...</p>
                                <p class="text-sm opacity-75">Loading with barakah</p>
                            </div>
                        `;
                        document.body.appendChild(loader);
                    }
                });
            });
        }

        // Initialize loading animations
        addLoadingAnimation();

        // Add Islamic motivational quotes rotation
        const islamicQuotes = [
            {
                text: "And whoever relies upon Allah - then He is sufficient for him",
                source: "At-Talaq 65:3"
            },
            {
                text: "And give good tidings to those who believe and do righteous deeds",
                source: "Al-Baqarah 2:25"
            },
            {
                text: "And whoever does righteous deeds, whether male or female, while being a believer, We will surely cause them to live a good life",
                source: "An-Nahl 16:97"
            },
            {
                text: "And Allah is the best of planners",
                source: "Al-Anfal 8:30"
            },
            {
                text: "So remember Me; I will remember you",
                source: "Al-Baqarah 2:152"
            }
        ];

        function rotateIslamicQuotes() {
            const quoteElement = document.querySelector('.mt-12 .bg-white p');
            const sourceElement = document.querySelector('.mt-12 .bg-white .text-primary');

            if (quoteElement && sourceElement) {
                let currentQuoteIndex = 0;

                setInterval(() => {
                    currentQuoteIndex = (currentQuoteIndex + 1) % islamicQuotes.length;
                    const quote = islamicQuotes[currentQuoteIndex];

                    // Fade out
                    quoteElement.style.opacity = '0';
                    sourceElement.style.opacity = '0';

                    setTimeout(() => {
                        quoteElement.textContent = `"${quote.text}"`;
                        sourceElement.textContent = `- ${quote.source}`;

                        // Fade in
                        quoteElement.style.opacity = '1';
                        sourceElement.style.opacity = '1';
                    }, 500);
                }, 10000); // Change quote every 10 seconds
            }
        }

        // Start quote rotation
        setTimeout(rotateIslamicQuotes, 5000);

        // Add particle effect for special occasions
        function createParticleEffect() {
            const particles = document.createElement('div');
            particles.className = 'fixed inset-0 pointer-events-none z-0';
            particles.innerHTML = `
                <div class="particle particle-1">🌟</div>
                <div class="particle particle-2">✨</div>
                <div class="particle particle-3">🌙</div>
                <div class="particle particle-4">⭐</div>
            `;

            const style = document.createElement('style');
            style.textContent = `
                .particle {
                    position: absolute;
                    font-size: 20px;
                    opacity: 0.7;
                    animation: float-particle 15s infinite linear;
                }

                .particle-1 { left: 10%; animation-delay: 0s; }
                .particle-2 { left: 30%; animation-delay: 5s; }
                .particle-3 { left: 70%; animation-delay: 10s; }
                .particle-4 { left: 90%; animation-delay: 15s; }

                @keyframes float-particle {
                    0% {
                        transform: translateY(100vh) rotate(0deg);
                        opacity: 0;
                    }
                    10% {
                        opacity: 0.7;
                    }
                    90% {
                        opacity: 0.7;
                    }
                    100% {
                        transform: translateY(-100px) rotate(360deg);
                        opacity: 0;
                    }
                }
            `;

            document.head.appendChild(style);
            document.body.appendChild(particles);
        }

        // Add particle effect on special occasions (like task completion)
        document.addEventListener('taskCompleted', createParticleEffect);

        // Enhanced task completion celebration
        document.querySelectorAll('form[action*="toggle"] button').forEach(button => {
            button.addEventListener('click', function() {
                const isCompleting = this.querySelector('.far.fa-circle');
                if (isCompleting) {
                    // Trigger particle effect
                    setTimeout(() => {
                        createParticleEffect();

                        // Play completion sound (if audio is enabled)
                        try {
                            const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSuBzvLZiTYIG2m98OScTgwOUarm7blmGgU7k9n0unEiBC13yO/eizEIHWq+8+OWT');
                            audio.volume = 0.3;
                            audio.play().catch(() => {}); // Ignore if audio fails
                        } catch (e) {}

                        // Show celebration message
                        showIslamicNotification('Alhamdulillah! Task completed with barakah! 🎉', 'success');
                    }, 300);
                }
            });
        });

        // Add Islamic calendar events reminder
        const islamicEvents = {
            'Idul Adha': 'Today is Idul Adha! Eid Mubarak! 🕌🐐',
            'Idul Fitri': 'Today is Idul Fitri! Eid Mubarak! 🌙✨',
            'Ramadan': 'Ramadan Kareem! May this blessed month bring peace 🌙',
            'Lailatul Qadr': 'Tonight might be Lailatul Qadr! 🌟'
        };

        // Check for Islamic events (simplified for demo)
        function checkIslamicEvents() {
            const today = new Date();
            const month = today.getMonth();
            const day = today.getDate();

            // Example: If it's around the time of Idul Adha (this is simplified)
            if (month === 6 && day >= 28 && day <= 30) { // Approximate
                setTimeout(() => {
                    showIslamicNotification(islamicEvents['Idul Adha'], 'success');
                }, 4000);
            }
        }

        checkIslamicEvents();

        // Add Bismillah before important actions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                console.log('Bismillah - Starting action with Allah\'s blessing');
            });
        });

        // Add Islamic touch to error handling
        window.addEventListener('error', function(e) {
            console.log('Inna lillahi wa inna ilayhi raji\'un - We belong to Allah and to Him we return');
        });

        // Add Dhikr counter (optional feature)
        let dhikrCount = localStorage.getItem('dhikrCount') || 0;

        function addDhikrCounter() {
            const dhikrButton = document.createElement('button');
            dhikrButton.className = 'fixed bottom-4 right-4 bg-primary text-white p-4 rounded-full shadow-lg hover:bg-secondary transition duration-300 z-40';
            dhikrButton.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-hand-holding-heart text-xl"></i>
                    <div class="text-xs mt-1">${dhikrCount}</div>
                </div>
            `;
            dhikrButton.title = 'SubhanAllah Counter';

            dhikrButton.addEventListener('click', function() {
                dhikrCount++;
                localStorage.setItem('dhikrCount', dhikrCount);
                this.querySelector('.text-xs').textContent = dhikrCount;

                // Show dhikr text briefly
                const dhikrText = document.createElement('div');
                dhikrText.className = 'fixed bottom-20 right-4 bg-primary text-white px-4 py-2 rounded-lg text-sm z-50';
                dhikrText.textContent = 'SubhanAllah';
                document.body.appendChild(dhikrText);

                setTimeout(() => {
                    dhikrText.remove();
                }, 1000);

                // Milestone celebrations
                if (dhikrCount % 33 === 0) {
                    showIslamicNotification(`Alhamdulillah! You've reached ${dhikrCount} dhikr! 🌟`, 'success');
                }
            });

            document.body.appendChild(dhikrButton);
        }

        // Add dhikr counter
        setTimeout(addDhikrCounter, 3000);
    </script>
</body>
</html>
