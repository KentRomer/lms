<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Instructor Dashboard - LearnHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-8">
                    <h1 class="text-2xl font-bold text-gray-800">LearnHub</h1>
                    <nav class="flex gap-6 text-sm">
                        <a href="/" class="text-blue-600 font-medium">Dashboard</a>
                        <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-blue-600">Courses</a>
                    </nav>
                </div>
                
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-3xl font-bold text-gray-900">My Courses</h2>
                <a href="{{ route('instructor.Courses.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition">
                    + Create Course
                </a>
            </div>
            <p class="text-gray-600">Manage and organize your courses</p>
        </div>

        @if($courses->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm p-16 text-center">
                <div class="max-w-md mx-auto">
                    <div class="text-6xl mb-4">📚</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No courses yet</h3>
                    <p class="text-gray-600 mb-6">Start by creating your first course</p>
                    <a href="{{ route('instructor.Courses.create') }}" 
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition">
                        Create Your First Course
                    </a>
                </div>
            </div>
        @else
            <!-- Course Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                 alt="{{ $course->title }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <span class="text-white text-5xl">📚</span>
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-1">
                                {{ $course->title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $course->short_description }}
                            </p>
                            
                            <div class="flex gap-4 text-sm text-gray-500 mb-6 pb-6 border-b">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    {{ $course->lessons_count }} lessons
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    {{ $course->enrollments_count }} students
                                </span>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('courses.show', $course->id) }}" 
                                   class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                                    View
                                </a>
                                <a href="{{ route('instructor.Courses.edit', $course->id) }}" 
                                   class="flex-1 text-center bg-blue-50 hover:bg-blue-100 text-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition">
                                    Edit
                                </a>
                                <a href="{{ route('instructor.lessons.create', $course->id) }}" 
                                   class="flex-1 text-center bg-green-50 hover:bg-green-100 text-green-600 px-4 py-2 rounded-lg text-sm font-medium transition">
                                    + Lesson
                                </a>
                                <form action="{{ route('instructor.courses.destroy', $course->id) }}" 
                                      method="POST" 
                                      class="flex-1"
                                      onsubmit="return confirm('Delete this course and all its lessons?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg text-sm font-medium transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-16">
        <div class="max-w-7xl mx-auto px-6 py-6">
            <p class="text-center text-gray-500 text-sm">
                © {{ date('Y') }} LearnHub. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>