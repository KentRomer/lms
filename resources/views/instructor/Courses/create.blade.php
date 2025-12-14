<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        // Apply dark mode IMMEDIATELY before page renders to prevent flash
        if (localStorage.getItem('dark_mode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Course - Simple LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#0e0919ff',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen transition-colors duration-200">
    <nav class="bg-white dark:bg-gray-800 shadow-lg border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-primary">Simple LMS</a>
                    <div class="ml-10 flex space-x-4">
                        <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Courses</a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <button onclick="toggleDarkMode()" class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="dark:hidden">🌙</span>
                        <span class="hidden dark:inline">☀️</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-4xl font-bold mb-8">Create New Course</h1>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return handleSubmit(event)">
                        @csrf

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium mb-2">Course Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="thumbnail" class="block text-sm font-medium mb-2">Course Thumbnail (Optional)</label>
                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Image file, max 2MB</p>
                            @error('thumbnail')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="short_description" class="block text-sm font-medium mb-2">Short Description</label>
                            <textarea name="short_description" id="short_description" rows="3" required
                                      class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium mb-2">Full Description</label>
                            <textarea name="content" id="content" rows="6" required
                                      class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" id="submitBtn" class="bg-primary hover:bg-blue-600 text-white px-6 py-2 rounded-md font-medium disabled:bg-gray-400 disabled:cursor-not-allowed">
                                Create Course
                            </button>
                            <a href="{{ route('instructor.dashboard') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md font-medium">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 dark:text-gray-400 text-sm">
                &copy; {{ date('Y') }} Simple LMS. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('dark_mode', isDark);
        }

        // Prevent duplicate form submissions
        function handleSubmit(event) {
            const submitBtn = document.getElementById('submitBtn');
            
            // Check if already submitted
            if (submitBtn.disabled) {
                event.preventDefault();
                return false;
            }
            
            // Disable button and change text
            submitBtn.disabled = true;
            submitBtn.textContent = 'Creating...';
            
            return true;
        }
    </script>
</body>
</html>