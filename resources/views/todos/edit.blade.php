<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task - Idul Adha Edition</title>
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
                        <i class="fas fa-edit text-gold text-3xl mr-4 animate-pulse"></i>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-gold rounded-full animate-ping"></div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gold font-poppins tracking-wide">Edit Task</h1>
                        <p class="text-sm text-cream opacity-90">Update with Barakah</p>
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
                <p class="text-sm opacity-75 mt-2">Update your task with Allah's guidance</p>
            </div>
        </div>

        <!-- Breadcrumb -->
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
                        <span class="text-sm font-medium text-gray-600">Edit Task</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Current Task Info with Enhanced Priority Display -->
        @php
            $currentPriorityBadge = '';
            $currentBorderClass = '';
            $priorityGradient = 'from-gray-100 to-gray-200';

            if($todo->deadline && $todo->status !== 'completed') {
                $deadline = \Carbon\Carbon::parse($todo->deadline);
                $now = \Carbon\Carbon::now();
                $diffInDays = $now->diffInDays($deadline, false);

                if($diffInDays < 0) {
                    $currentPriorityBadge = '<span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-red-200 text-red-800 animate-pulse"><i class="fas fa-fire mr-2"></i>URGENT</span>';
                    $currentBorderClass = 'border-l-8 border-red-500';
                    $priorityGradient = 'from-red-100 to-red-200';
                } elseif($diffInDays == 0) {
                    $currentPriorityBadge = '<span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-orange-200 text-orange-800"><i class="fas fa-bell mr-2"></i>TODAY</span>';
                    $currentBorderClass = 'border-l-8 border-orange-500';
                    $priorityGradient = 'from-orange-100 to-orange-200';
                } elseif($diffInDays == 1) {
                    $currentPriorityBadge = '<span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-200 text-yellow-800"><i class="fas fa-arrow-right mr-2"></i>TOMORROW</span>';
                    $currentBorderClass = 'border-l-8 border-yellow-500';
                    $priorityGradient = 'from-yellow-100 to-yellow-200';
                } elseif($diffInDays <= 7) {
                    $currentPriorityBadge = '<span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-blue-200 text-blue-800"><i class="fas fa-calendar-week mr-2"></i>THIS WEEK</span>';
                    $currentBorderClass = 'border-l-8 border-blue-500';
                    $priorityGradient = 'from-blue-100 to-blue-200';
                }
            }
        @endphp

        <div class="bg-gradient-to-r {{ $priorityGradient }} rounded-3xl p-8 mb-8 shadow-2xl {{ $currentBorderClass }} relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-20 rounded-full -mr-20 -mt-20"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2 flex items-center">
                            <i class="fas fa-edit mr-3 text-primary"></i>
                            Currently Editing with Barakah
                        </h3>
                        <p class="text-xl text-gray-700 font-semibold">{{ $todo->title }}</p>
                        @if($todo->deadline)
                            <p class="text-gray-600 mt-2 flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                Deadline: {{ \Carbon\Carbon::parse($todo->deadline)->format('M d, Y') }}
                            </p>
                        @endif
                    </div>
                    <div class="text-right space-y-3">
                        @if($todo->status === 'completed')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-200 text-green-800">
                                <i class="fas fa-check mr-2"></i>Completed
                            </span>
                        @elseif($todo->status === 'late')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-red-200 text-red-800">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Late
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-200 text-yellow-800">
                                <i class="fas fa-clock mr-2"></i>Pending
                            </span>
                        @endif

                        @if($currentPriorityBadge)
                            <div>
                                {!! $currentPriorityBadge !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Form Card -->
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-primary to-secondary p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">Update Task Details</h2>
                        <p class="text-cream opacity-90">Modify the task information below with Allah's guidance.</p>
                    </div>
                    <div class="text-6xl opacity-30">
                        <i class="fas fa-edit"></i>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form action="{{ route('todos.update', $todo) }}" method="POST" class="space-y-8" id="updateForm">
                    @csrf
                    @method('PUT')

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
                                   value="{{ old('title', $todo->title) }}"
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
                                      placeholder="Describe your task in detail... May Allah make it easy for you.">{{ old('description', $todo->description) }}</textarea>
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
                                   value="{{ old('deadline', $todo->deadline ? \Carbon\Carbon::parse($todo->deadline)->format('Y-m-d') : '') }}"
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
                            <i class="fas fa-eye mr-2 text-primary"></i>New Priority Preview
                        </h4>
                        <div id="priorityIndicator" class="text-sm"></div>
                    </div>

                    <!-- Status Field -->
                    <div class="group">
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-flag mr-2 text-primary"></i>Status *
                            <span class="text-xs text-gray-500 ml-2">(Current progress of your task)</span>
                        </label>
                        <div class="relative">
                            <select id="status"
                                    name="status"
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary transition duration-300 text-lg @error('status') border-red-500 @enderror"
                                    required>
                                <option value="pending" {{ old('status', $todo->status) === 'pending' ? 'selected' : '' }}>
                                    📋 Pending - Ready to start
                                </option>
                                <option value="late" {{ old('status', $todo->status) === 'late' ? 'selected' : '' }}>
                                    ⚠️ Late - Needs immediate attention
                                </option>
                                <option value="completed" {{ old('status', $todo->status) === 'completed' ? 'selected' : '' }}>
                                    ✅ Completed - Alhamdulillah!
                                </option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                                <i class="fas fa-chevron-down text-gray-400 group-focus-within:text-primary transition duration-300"></i>
                            </div>
                        </div>
                        @error('status')
                            <p class="mt-3 text-sm text-red-600 flex items-center bg-red-50 p-3 rounded-xl">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Task Metadata -->
                    <div class="bg-gradient-to-r from-lightGold to-cream rounded-2xl p-6 border border-accent">
                        <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-primary"></i>Task Information
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                            <div class="bg-white rounded-xl p-4 shadow-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-plus text-primary mr-3"></i>
                                    <div>
                                        <span class="text-gray-600 block">Created:</span>
                                        <span class="text-gray-900 font-semibold">{{ $todo->created_at->format('M d, Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-edit text-secondary mr-3"></i>
                                    <div>
                                        <span class="text-gray-600 block">Last Updated:</span>
                                        <span class="text-gray-900 font-semibold">{{ $todo->updated_at->format('M d, Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                            @if($todo->completed_at)
                                <div class="md:col-span-2 bg-green-50 rounded-xl p-4 border border-green-200">
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                        <div>
                                            <span class="text-gray-600 block">Completed with Barakah:</span>
                                            <span class="text-green-600 font-bold">{{ \Carbon\Carbon::parse($todo->completed_at)->format('M d, Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-8 border-t-2 border-gray-100">
                        <a href="{{ route('home') }}" class="bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 px-8 py-4 rounded-2xl font-semibold transition duration-300 transform hover:scale-105 flex items-center shadow-lg">
                            <i class="fas fa-times mr-3"></i>Cancel
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white px-10 py-4 rounded-2xl font-semibold transition duration-300 transform hover:scale-105 flex items-center shadow-xl">
                            <i class="fas fa-save mr-3"></i>Update Task with Barakah
                        </button>
                    </div>
                </form>

                <!-- Delete Form (Separate) -->
                <div class="mt-6 pt-6 border-t-2 border-gray-100">
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this task? This action cannot be undone. May Allah guide your decision.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-gradient-to-r from-red-100 to-red-200 hover:from-red-200 hover:to-red-300 text-red-700 px-8 py-4 rounded-2xl font-semibold transition duration-300 transform hover:scale-105 flex items-center shadow-lg">
                            <i class="fas fa-trash mr-3"></i>Delete Task
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="mt-8 bg-white rounded-3xl shadow-2xl border border-gray-100 p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-bolt mr-3 text-accent"></i>Quick Actions with Barakah
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Toggle Status -->
                <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="w-full">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 text-blue-700 px-6 py-4 rounded-2xl font-semibold transition duration-300 transform hover:scale-105 flex items-center justify-center shadow-lg">
                        @if($todo->status === 'completed')
                            <i class="fas fa-undo mr-3"></i>Mark as Pending
                        @else
                            <i class="fas fa-check mr-3"></i>Mark as Complete
                        @endif
                    </button>
                </form>

                <!-- Duplicate Task -->
                <a href="{{ route('todos.create') }}?duplicate={{ $todo->id }}" class="w-full bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 text-green-700 px-6 py-4 rounded-2xl font-semibold transition duration-300 transform hover:scale-105 flex items-center justify-center shadow-lg">
                    <i class="fas fa-copy mr-3"></i>Duplicate Task
                </a>

                <!-- View All Tasks -->
                <a href="{{ route('home') }}" class="w-full bg-gradient-to-r from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 text-purple-700 px-6 py-4 rounded-2xl font-semibold transition duration-300 transform hover:scale-105 flex items-center justify-center shadow-lg">
                    <i class="fas fa-list mr-3"></i>View All Tasks
                </a>
            </div>
        </div>

        <!-- Enhanced Priority & Status Guide -->
        <div class="mt-8 bg-gradient-to-r from-accent to-gold rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-10 rounded-full -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-white opacity-10 rounded-full -ml-16 -mb-16"></div>

            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-6 flex items-center">
                    <i class="fas fa-question-circle mr-3"></i>Priority & Status Guide
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="font-bold text-xl mb-4">Deadline Priority</h4>
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-white bg-opacity-20 rounded-xl backdrop-blur-sm">
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-red-200 text-red-800 mr-4 animate-pulse">
                                    <i class="fas fa-fire mr-1"></i>URGENT
                                </span>
                                <span>Overdue tasks (highest priority)</span>
                            </div>
                            <div class="flex items-center p-4 bg-white bg-opacity-20 rounded-xl backdrop-blur-sm">
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-orange-200 text-orange-800 mr-4">
                                    <i class="fas fa-bell mr-1"></i>TODAY
                                </span>
                                <span>Due today</span>
                            </div>
                            <div class="flex items-center p-4 bg-white bg-opacity-20 rounded-xl backdrop-blur-sm">
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-yellow-200 text-yellow-800 mr-4">
                                    <i class="fas fa-arrow-right mr-1"></i>TOMORROW
                                </span>
                                <span>Due tomorrow</span>
                            </div>
                            <div class="flex items-center p-4 bg-white bg-opacity-20 rounded-xl backdrop-blur-sm">
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-blue-200 text-blue-800 mr-4">
                                    <i class="fas fa-calendar-week mr-1"></i>THIS WEEK
                                </span>
                                <span>Due within 7 days</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-bold text-xl mb-4">Task Status</h4>
                        <div class="space-y-4">
                            <div class="flex items-start p-4 bg-white bg-opacity-20 rounded-xl backdrop-blur-sm">
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-yellow-200 text-yellow-800 mr-4 mt-0.5">
                                    <i class="fas fa-clock mr-1"></i>Pending
                                </span>
                                <span>Task is active and waiting to be completed</span>
                            </div>
                            <div class="flex items-start p-4 bg-white bg-opacity-20 rounded-xl backdrop-blur-sm">
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-red-200
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-red-200 text-red-800 mr-4 mt-0.5">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>Late
                                </span>
                                <span>Task has passed its deadline and is overdue</span>
                            </div>
                            <div class="flex items-start p-4 bg-white bg-opacity-20 rounded-xl backdrop-blur-sm">
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-green-200 text-green-800 mr-4 mt-0.5">
                                    <i class="fas fa-check mr-1"></i>Completed
                                </span>
                                <span>Task has been finished successfully - Alhamdulillah!</span>
                            </div>
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
                    "And it is He who created the heavens and earth in truth. And the day He says, 'Be,' and it is, His word is the truth."
                </p>
                <p class="text-primary font-bold text-lg">- Al-An'am 6:73</p>
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
        input:focus, textarea:focus, select:focus {
            box-shadow: 0 0 0 4px rgba(139, 69, 19, 0.1);
        }

        /* Button hover effects */
        button:hover, a:hover {
            box-shadow: 0 10px 25px rgba(139, 69, 19, 0.2);
        }

        /* Pulse animation for urgent tasks */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .5;
            }
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Slide down animation */
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
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bismillah notification
            setTimeout(() => {
                showIslamicNotification('Bismillah! Edit your task with Allah\'s guidance 🌟', 'info');
            }, 1000);

            // Add floating animation to decorative elements
            const decorativeElements = document.querySelectorAll('.fas.fa-edit');
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

                if (diffDays < 0) {
                    priorityHTML = `
                        <div class="flex items-center p-4 border-l-4 border-red-500 bg-gradient-to-r from-red-50 to-red-100 rounded-xl">
                            <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-bold bg-red-200 text-red-800 mr-4 animate-pulse">
                                <i class="fas fa-fire mr-2"></i>URGENT
                            </span>
                            <span class="text-gray-700 font-medium">This blessed task will be overdue (highest priority)</span>
                        </div>
                    `;
                } else if (diffDays === 0) {
                    priorityHTML = `
                        <div class="flex items-center p-4 border-l-4 border-orange-500 bg-gradient-to-r from-orange-50 to-orange-100 rounded-xl">
                            <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-bold bg-orange-200 text-orange-800 mr-4">
                                <i class="fas fa-bell mr-2"></i>TODAY
                            </span>
                            <span class="text-gray-700 font-medium">This task will be due today (high priority)</span>
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

        // Auto-update status based on deadline
        document.getElementById('deadline').addEventListener('change', function() {
            const deadline = new Date(this.value);
            const today = new Date();
            const statusSelect = document.getElementById('status');

            if (deadline < today && statusSelect.value === 'pending') {
                statusSelect.value = 'late';
                showIslamicNotification('Status automatically changed to "Late" due to past deadline. May Allah make it easy for you.', 'warning');
            }
        });

        // Status change confirmation for completed tasks
        document.getElementById('status').addEventListener('change', function() {
            if (this.value === 'completed') {
                const confirmed = confirm('Mark this task as completed? Alhamdulillah! This will set the completion timestamp and celebrate your achievement.');
                if (!confirmed) {
                    this.value = '{{ old('status', $todo->status) }}';
                } else {
                    showIslamicNotification('Alhamdulillah! Task will be marked as completed 🎉', 'success');
                }
            }
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

        // Form validation enhancement
        document.getElementById('updateForm').addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            if (title.length < 3) {
                e.preventDefault();
                showIslamicNotification('SubhanAllah! Task title must be at least 3 characters long', 'warning');
                document.getElementById('title').focus();
                return false;
            }

            // Show success message
            showIslamicNotification('Bismillah! Updating your blessed task...', 'success');
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

        // Initialize character counters
        titleInput.dispatchEvent(new
        // Initialize character counters
        titleInput.dispatchEvent(new Event('input'));
        descInput.dispatchEvent(new Event('input'));

        // Enhanced form interactions with Islamic touch
        const formInputs = document.querySelectorAll('input, textarea, select');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
                // Add gentle glow effect
                this.style.boxShadow = '0 0 20px rgba(139, 69, 19, 0.3)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
                this.style.boxShadow = '';
            });
        });

        // Islamic phrases for motivation
        const islamicPhrases = [
            'Bismillah - In the name of Allah 🌟',
            'Alhamdulillah - All praise is due to Allah 🙏',
            'SubhanAllah - Glory be to Allah ✨',
            'InshaAllah - If Allah wills 🤲',
            'MashaAllah - What Allah has willed 💫',
            'Barakallahu feeki - May Allah bless you 🌙',
            'Tawakkul - Trust in Allah 💝',
            'Sabr - Patience brings reward 🌸'
        ];

        // Show random Islamic phrase on form interaction
        let phraseTimeout;
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                clearTimeout(phraseTimeout);
                phraseTimeout = setTimeout(() => {
                    const randomPhrase = islamicPhrases[Math.floor(Math.random() * islamicPhrases.length)];
                    showIslamicNotification(randomPhrase, 'info');
                }, 3000);
            });
        });

        // Keyboard shortcuts with Islamic touch
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S for save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.getElementById('updateForm').submit();
                showIslamicNotification('Bismillah! Saving your blessed task... 💫', 'success');
            }

            // Ctrl/Cmd + Escape for cancel
            if ((e.ctrlKey || e.metaKey) && e.key === 'Escape') {
                e.preventDefault();
                window.location.href = "{{ route('home') }}";
            }
        });

        // Enhanced visual feedback for form validation
        const form = document.getElementById('updateForm');
        const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');

        inputs.forEach(input => {
            input.addEventListener('invalid', function(e) {
                e.preventDefault();
                this.classList.add('border-red-500', 'bg-red-50');
                this.style.animation = 'shake 0.5s ease-in-out';
                showIslamicNotification('Please fill in all required fields with Barakah 🌟', 'warning');

                // Remove error styling after user starts typing
                this.addEventListener('input', function() {
                    this.classList.remove('border-red-500', 'bg-red-50');
                    this.style.animation = '';
                }, { once: true });
            });
        });

        // Add loading state to submit button
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Updating with Barakah... 🌟';
            submitBtn.classList.add('opacity-75');

            // Re-enable after 3 seconds (in case of validation errors)
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                submitBtn.classList.remove('opacity-75');
            }, 3000);
        });

        // Add Islamic date display
        const today = new Date();
        const islamicDateDiv = document.createElement('div');
        islamicDateDiv.className = 'fixed bottom-4 left-4 bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-2xl text-sm opacity-90 shadow-xl backdrop-blur-sm';
        islamicDateDiv.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-3 text-gold"></i>
                <div>
                    <div class="font-semibold">${today.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</div>
                    <div class="text-xs opacity-75">May Allah bless this day</div>
                </div>
            </div>
        `;
        document.body.appendChild(islamicDateDiv);

        // Add prayer time reminder
        const prayerReminder = document.createElement('div');
        prayerReminder.className = 'fixed bottom-4 right-4 bg-gradient-to-r from-accent to-gold text-white px-6 py-3 rounded-2xl text-sm opacity-0 transition-all duration-500 shadow-xl backdrop-blur-sm';
        prayerReminder.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-mosque mr-3 text-2xl"></i>
                <div>
                    <div class="font-semibold">Remember your prayers 🤲</div>
                    <div class="text-xs opacity-75">Allah is always with you</div>
                </div>
            </div>
        `;
        document.body.appendChild(prayerReminder);

        // Show prayer reminder every 45 seconds
        setInterval(() => {
            prayerReminder.style.opacity = '1';
            prayerReminder.style.transform = 'translateY(0)';
            setTimeout(() => {
                prayerReminder.style.opacity = '0';
                prayerReminder.style.transform = 'translateY(20px)';
            }, 4000);
        }, 45000);

        // Add Barakah effect on successful actions
        function addBarakahEffect(element) {
            const barakah = document.createElement('div');
            barakah.className = 'absolute inset-0 bg-gradient-to-r from-gold to-accent opacity-30 rounded-2xl pointer-events-none';
            barakah.style.animation = 'pulse 1s ease-in-out';

            element.style.position = 'relative';
            element.appendChild(barakah);

            setTimeout(() => {
                barakah.remove();
            }, 1000);
        }

        // Add Barakah effect to buttons on hover
        const buttons = document.querySelectorAll('button, a[class*="bg-"]');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                if (!this.disabled) {
                    addBarakahEffect(this);
                }
            });
        });

        // Add completion celebration
        const statusSelect = document.getElementById('status');
        statusSelect.addEventListener('change', function() {
            if (this.value === 'completed') {
                // Create celebration effect
                const celebration = document.createElement('div');
                celebration.className = 'fixed inset-0 pointer-events-none z-50';
                celebration.innerHTML = `
                    <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-500 opacity-20 animate-pulse"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center">
                        <div class="text-8xl mb-4">🎉</div>
                        <div class="text-4xl font-bold text-green-600 mb-2">Alhamdulillah!</div>
                        <div class="text-xl text-green-500">Task completed with Barakah!</div>
                    </div>
                `;

                document.body.appendChild(celebration);

                setTimeout(() => {
                    celebration.remove();
                }, 3000);
            }
        });

        // Auto-save functionality (draft)
        let autoSaveTimeout;
        const autoSaveInputs = document.querySelectorAll('#title, #description');

        autoSaveInputs.forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(() => {
                    // Save to localStorage as draft
                    const draftData = {
                        title: document.getElementById('title').value,
                        description: document.getElementById('description').value,
                        deadline: document.getElementById('deadline').value,
                        status: document.getElementById('status').value,
                        timestamp: new Date().toISOString()
                    };

                    localStorage.setItem('taskEditDraft_{{ $todo->id }}', JSON.stringify(draftData));

                    // Show subtle save indicator
                    const saveIndicator = document.createElement('div');
                    saveIndicator.className = 'fixed top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-4 py-2 rounded-full text-sm opacity-0 transition-all duration-300 shadow-lg';
                    saveIndicator.innerHTML = '<i class="fas fa-save mr-2"></i>Draft saved with Barakah ✓';

                    document.body.appendChild(saveIndicator);

                    setTimeout(() => {
                        saveIndicator.style.opacity = '1';
                    }, 100);

                    setTimeout(() => {
                        saveIndicator.style.opacity = '0';
                        setTimeout(() => {
                            saveIndicator.remove();
                        }, 300);
                    }, 2000);
                }, 2000);
            });
        });

        // Load draft on page load
        const draftKey = 'taskEditDraft_{{ $todo->id }}';
        const savedDraft = localStorage.getItem(draftKey);

        if (savedDraft) {
            const draftData = JSON.parse(savedDraft);
            const draftAge = new Date() - new Date(draftData.timestamp);

            // Only load draft if it's less than 1 hour old
            if (draftAge < 3600000) {
                const loadDraft = confirm('A recent draft was found. Would you like to load it? (Bismillah)');

                if (loadDraft) {
                    document.getElementById('title').value = draftData.title || '';
                    document.getElementById('description').value = draftData.description || '';
                    document.getElementById('deadline').value = draftData.deadline || '';
                    document.getElementById('status').value = draftData.status || 'pending';

                    showIslamicNotification('Draft loaded successfully! Alhamdulillah 🌟', 'success');

                    // Trigger character counters
                    titleInput.dispatchEvent(new Event('input'));
                    descInput.dispatchEvent(new Event('input'));
                }
            }
        }

        // Clear draft on successful submission
        form.addEventListener('submit', function() {
            localStorage.removeItem(draftKey);
        });

        // Add Islamic pattern animation
        const patterns = document.querySelectorAll('.islamic-pattern');
        patterns.forEach(pattern => {
            pattern.style.animation = 'float 6s ease-in-out infinite';
        });

        // Add shake animation for validation errors
        const shakeKeyframes = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }
        `;

        const styleSheet = document.createElement('style');
        styleSheet.textContent = shakeKeyframes;
        document.head.appendChild(styleSheet);

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Add typing effect for Islamic quotes
        const quotes = [
            "And whoever relies upon Allah - then He is sufficient for him. (At-Talaq 65:3)",
            "And Allah is the best of planners. (Al-Anfal 8:30)",
            "So remember Me; I will remember you. (Al-Baqarah 2:152)",
            "And whoever fears Allah - He will make for him a way out. (At-Talaq 65:2)",
            "And it is He who created the heavens and earth in truth. (Al-An'am 6:73)"
        ];

        let currentQuoteIndex = 0;
        const quoteElement = document.querySelector('.text-gray-700.italic');

        if (quoteElement) {
            function typeQuote(text, element, callback) {
                element.textContent = '';
                let i = 0;
                const timer = setInterval(() => {
                    if (i < text.length) {
                        element.textContent += text.charAt(i);
                        i++;
                    } else {
                        clearInterval(timer);
                        if (callback) callback();
                    }
                }, 50);
            }

            function rotateQuotes() {
                const currentQuote = quotes[currentQuoteIndex];
                typeQuote(currentQuote, quoteElement, () => {
                    setTimeout(() => {
                        currentQuoteIndex = (currentQuoteIndex + 1) % quotes.length;
                        setTimeout(rotateQuotes, 1000);
                    }, 8000);
                });
            }

            // Start quote rotation after 3 seconds
            setTimeout(rotateQuotes, 3000);
        }

        // Add floating particles effect
        function createFloatingParticle() {
            const particle = document.createElement('div');
            particle.className = 'fixed pointer-events-none z-10';
            particle.style.left = Math.random() * window.innerWidth + 'px';
            particle.style.top = window.innerHeight + 'px';
            particle.style.width = '4px';
            particle.style.height = '4px';
            particle.style.background = 'linear-gradient(45deg, #FFD700, #DAA520)';
            particle.style.borderRadius = '50%';
            particle.style.opacity = '0.7';

            document.body.appendChild(particle);

            const animation = particle.animate([
                { transform: 'translateY(0px) rotate(0deg)', opacity: 0.7 },
                { transform: `translateY(-${window.innerHeight + 100}px) rotate(360deg)`, opacity: 0 }
            ], {
                duration: 8000 + Math.random() * 4000,
                easing: 'linear'
            });

            animation.onfinish = () => particle.remove();
        }

        // Create floating particles every 3 seconds
        setInterval(createFloatingParticle, 3000);

        // Add final blessing message on page unload
        window.addEventListener('beforeunload', function() {
            localStorage.setItem('lastEditSession', JSON.stringify({
                taskId:
        // Add final blessing message on page unload
        window.addEventListener('beforeunload', function() {
            localStorage.setItem('lastEditSession', JSON.stringify({
                taskId: '{{ $todo->id }}',
                taskTitle: '{{ $todo->title }}',
                timestamp: new Date().toISOString(),
                blessing: 'May Allah bless your efforts and make your tasks easy'
            }));
        });

        // Show returning user blessing
        const lastSession = localStorage.getItem('lastEditSession');
        if (lastSession) {
            const sessionData = JSON.parse(lastSession);
            const sessionAge = new Date() - new Date(sessionData.timestamp);

            // If returning within 24 hours
            if (sessionAge < 86400000) {
                setTimeout(() => {
                    showIslamicNotification(`Welcome back! ${sessionData.blessing} 🌟`, 'info');
                }, 2000);
            }
        }

        // Add Islamic calendar integration
        function getIslamicDate() {
            const today = new Date();
            const islamicMonths = [
                'Muharram', 'Safar', 'Rabi\' al-awwal', 'Rabi\' al-thani',
                'Jumada al-awwal', 'Jumada al-thani', 'Rajab', 'Sha\'ban',
                'Ramadan', 'Shawwal', 'Dhu al-Qi\'dah', 'Dhu al-Hijjah'
            ];

            // Simplified Islamic date calculation (approximate)
            const islamicYear = Math.floor((today.getFullYear() - 622) * 1.030684) + 1;
            const monthIndex = Math.floor(Math.random() * 12); // Simplified for demo
            const day = Math.floor(Math.random() * 29) + 1;

            return `${day} ${islamicMonths[monthIndex]} ${islamicYear} AH`;
        }

        // Update Islamic date in the bottom display
        const islamicDate = getIslamicDate();
        setTimeout(() => {
            const islamicDateElement = document.querySelector('.fixed.bottom-4.left-4');
            if (islamicDateElement) {
                islamicDateElement.innerHTML += `
                    <div class="text-xs opacity-75 mt-1 border-t border-white border-opacity-20 pt-2">
                        <i class="fas fa-moon mr-1"></i>${islamicDate}
                    </div>
                `;
            }
        }, 1000);

        // Add Dhikr counter for productivity
        let dhikrCount = parseInt(localStorage.getItem('dailyDhikrCount')) || 0;
        const dhikrPhrases = ['SubhanAllah', 'Alhamdulillah', 'Allahu Akbar', 'La ilaha illa Allah'];

        function showDhikrReminder() {
            const dhikrDiv = document.createElement('div');
            dhikrDiv.className = 'fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gradient-to-r from-primary to-secondary text-white p-8 rounded-3xl shadow-2xl z-50 text-center max-w-md';
            dhikrDiv.innerHTML = `
                <div class="text-4xl mb-4">📿</div>
                <h3 class="text-xl font-bold mb-3">Take a moment for Dhikr</h3>
                <p class="mb-4 opacity-90">Remember Allah while working on your tasks</p>
                <div class="space-y-2">
                    ${dhikrPhrases.map(phrase => `
                        <button onclick="incrementDhikr('${phrase}'); this.parentElement.parentElement.parentElement.remove();"
                                class="block w-full bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-xl transition duration-300">
                            ${phrase}
                        </button>
                    `).join('')}
                </div>
                <button onclick="this.parentElement.remove()" class="mt-4 text-sm opacity-75 hover:opacity-100">
                    Continue working
                </button>
            `;

            document.body.appendChild(dhikrDiv);
        }

        function incrementDhikr(phrase) {
            dhikrCount++;
            localStorage.setItem('dailyDhikrCount', dhikrCount.toString());
            showIslamicNotification(`${phrase} (${dhikrCount} today) - Barakallahu feeki! 🌟`, 'success');
        }

        // Show Dhikr reminder every 10 minutes
        setInterval(showDhikrReminder, 600000);

        // Add productivity stats
        function updateProductivityStats() {
            const stats = JSON.parse(localStorage.getItem('productivityStats')) || {
                tasksEdited: 0,
                timeSpent: 0,
                lastActive: new Date().toISOString()
            };

            stats.tasksEdited++;
            stats.lastActive = new Date().toISOString();
            localStorage.setItem('productivityStats', JSON.stringify(stats));
        }

        // Track time spent on page
        const startTime = Date.now();
        window.addEventListener('beforeunload', function() {
            const timeSpent = Date.now() - startTime;
            const stats = JSON.parse(localStorage.getItem('productivityStats')) || { timeSpent: 0 };
            stats.timeSpent += timeSpent;
            localStorage.setItem('productivityStats', JSON.stringify(stats));
        });

        // Add motivational progress tracking
        const progressTracker = {
            init() {
                const progress = JSON.parse(localStorage.getItem('editProgress')) || {
                    editsToday: 0,
                    lastEditDate: null,
                    totalEdits: 0,
                    streak: 0
                };

                const today = new Date().toDateString();

                if (progress.lastEditDate !== today) {
                    if (progress.lastEditDate === new Date(Date.now() - 86400000).toDateString()) {
                        progress.streak++;
                    } else {
                        progress.streak = 1;
                    }
                    progress.editsToday = 1;
                    progress.lastEditDate = today;
                } else {
                    progress.editsToday++;
                }

                progress.totalEdits++;
                localStorage.setItem('editProgress', JSON.stringify(progress));

                this.showProgressMessage(progress);
            },

            showProgressMessage(progress) {
                setTimeout(() => {
                    let message = '';
                    if (progress.streak >= 7) {
                        message = `MashaAllah! ${progress.streak} day streak! 🔥`;
                    } else if (progress.editsToday === 1) {
                        message = `First edit today! Bismillah 🌅`;
                    } else if (progress.editsToday === 5) {
                        message = `5th edit today! Very productive! 💪`;
                    } else if (progress.totalEdits % 10 === 0) {
                        message = `${progress.totalEdits} total edits! Alhamdulillah! 🎯`;
                    }

                    if (message) {
                        showIslamicNotification(message, 'success');
                    }
                }, 1500);
            }
        };

        progressTracker.init();

        // Add keyboard accessibility
        document.addEventListener('keydown', function(e) {
            // Alt + 1-9 for quick navigation
            if (e.altKey && e.key >= '1' && e.key <= '9') {
                e.preventDefault();
                const inputs = document.querySelectorAll('input, textarea, select');
                const index = parseInt(e.key) - 1;
                if (inputs[index]) {
                    inputs[index].focus();
                    showIslamicNotification(`Navigated to field ${e.key} 🎯`, 'info');
                }
            }

            // Alt + S for status toggle
            if (e.altKey && e.key === 's') {
                e.preventDefault();
                const statusSelect = document.getElementById('status');
                const currentIndex = statusSelect.selectedIndex;
                const nextIndex = (currentIndex + 1) % statusSelect.options.length;
                statusSelect.selectedIndex = nextIndex;
                statusSelect.dispatchEvent(new Event('change'));
                showIslamicNotification(`Status changed to: ${statusSelect.options[nextIndex].text} ✨`, 'info');
            }
        });

        // Add focus management for better UX
        const focusableElements = document.querySelectorAll('input, textarea, select, button, a[href]');
        let currentFocusIndex = -1;

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                currentFocusIndex = Array.from(focusableElements).indexOf(document.activeElement);
            }
        });

        // Add form completion percentage
        function updateFormCompletion() {
            const requiredFields = document.querySelectorAll('input[required], textarea[required], select[required]');
            const filledFields = Array.from(requiredFields).filter(field => field.value.trim() !== '');
            const percentage = Math.round((filledFields.length / requiredFields.length) * 100);

            let completionIndicator = document.getElementById('completionIndicator');
            if (!completionIndicator) {
                completionIndicator = document.createElement('div');
                completionIndicator.id = 'completionIndicator';
                completionIndicator.className = 'fixed top-20 right-4 bg-white rounded-2xl shadow-xl p-4 border-l-4 border-primary z-40';
                document.body.appendChild(completionIndicator);
            }

            completionIndicator.innerHTML = `
                <div class="flex items-center">
                    <div class="mr-3">
                        <div class="w-12 h-12 rounded-full border-4 border-gray-200 relative">
                            <div class="absolute inset-0 rounded-full border-4 border-primary"
                                 style="clip-path: polygon(50% 50%, 50% 0%, ${percentage > 50 ? '100% 0%, 100%' : '50%'} ${percentage * 3.6}deg, 50% 50%)"></div>
                            <div class="absolute inset-0 flex items-center justify-center text-xs font-bold text-primary">
                                ${percentage}%
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Form Progress</div>
                        <div class="text-sm text-gray-600">${filledFields.length}/${requiredFields.length} fields</div>
                        <div class="text-xs text-primary">Barakallahu feeki!</div>
                    </div>
                </div>
            `;

            if (percentage === 100) {
                completionIndicator.classList.add('animate-pulse');
                setTimeout(() => {
                    completionIndicator.style.opacity = '0';
                    setTimeout(() => {
                        completionIndicator.remove();
                    }, 500);
                }, 3000);
            }
        }

        // Monitor form completion
        const monitoredFields = document.querySelectorAll('input, textarea, select');
        monitoredFields.forEach(field => {
            field.addEventListener('input', updateFormCompletion);
            field.addEventListener('change', updateFormCompletion);
        });

        // Initial completion check
        updateFormCompletion();

        // Add final touches and cleanup
        console.log('🌟 Islamic Todo Edit Page Loaded with Barakah! 🌟');
        console.log('May Allah bless your productivity and make your tasks easy.');

        // Add performance monitoring
        window.addEventListener('load', function() {
            const loadTime = performance.now();
            if (loadTime > 3000) {
                showIslamicNotification('Page loaded. May Allah grant you patience 🤲', 'info');
            }
        });
    </script>
</body>
</html>
