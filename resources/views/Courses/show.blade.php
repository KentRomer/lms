<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $course->title }} - Simple LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Simple Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Simple LMS</h1>
                <nav class="flex gap-6 text-sm">
                    <a href="/" class="text-gray-600 hover:text-blue-600">Dashboard</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Courses</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-6 py-8">
        <!-- Course Header -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            @if($course->thumbnail)
                <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                     alt="{{ $course->title }}" 
                     class="w-full h-64 object-cover">
            @else
                <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <span class="text-white text-6xl">📚</span>
                </div>
            @endif

            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $course->title }}</h1>
                <p class="text-xl text-gray-600 mb-6">{{ $course->short_description }}</p>
                
                <div class="flex gap-6 text-sm text-gray-500 pb-6 border-b">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        {{ $course->lessons->count() }} lessons
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        {{ $course->enrollments->count() }} students
                    </span>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">About this course</h3>
                    <div class="text-gray-700 prose">
                        {!! nl2br(e($course->content)) !!}
                    </div>
                </div>
            </div>
        </div>

       <!-- Course Lessons -->
<div class="bg-white rounded-xl shadow-sm p-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Course Lessons</h2>
    
    @if($course->lessons->isEmpty())
        <div class="text-center py-12">
            <div class="text-4xl mb-4">📝</div>
            <p class="text-gray-600">No lessons added yet</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($course->lessons->sortBy('order') as $lesson)
                <div class="border rounded-lg p-6 hover:border-blue-500 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium">
                                    Lesson {{ $lesson->order }}
                                </span>
                                <h3 class="text-xl font-semibold text-gray-900">{{ $lesson->title }}</h3>
                            </div>
                            <p class="text-gray-600">{{ Str::limit($lesson->content, 150) }}</p>
                        </div>
                        
                        <!-- Edit and Delete Buttons (only show for instructors) -->
                        <div class="flex gap-2 ml-4">
                            <a href="{{ route('instructor.lessons.edit', [$course->id, $lesson->id]) }}" 
                               class="bg-blue-50 hover:bg-blue-100 text-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition">
                                Edit
                            </a>
                            <form action="{{ route('instructor.lessons.destroy', [$course->id, $lesson->id]) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this lesson?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg text-sm font-medium transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="/" class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium transition">
                ← Back to Dashboard
            </a>
        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="bg-white border-t mt-16">
        <div class="max-w-7xl mx-auto px-6 py-6">
            <p class="text-center text-gray-500 text-sm">
                © {{ date('Y') }} Simple LMS. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>