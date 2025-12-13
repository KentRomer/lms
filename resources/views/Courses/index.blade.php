<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>All Courses - Simple LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-8">
                    <h1 class="text-2xl font-bold text-gray-800">Simple LMS</h1>
                    <nav class="flex gap-6 text-sm">
                        <a href="/" class="text-gray-600 hover:text-blue-600">Dashboard</a>
                        <a href="{{ route('courses.index') }}" class="text-blue-600 font-medium">Courses</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">All Courses</h2>
            <p class="text-gray-600">Browse all available courses</p>
        </div>

        @if($courses->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm p-16 text-center">
                <div class="max-w-md mx-auto">
                    <div class="text-6xl mb-4">📚</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No courses available</h3>
                    <p class="text-gray-600">Check back later for new courses!</p>
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
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $course->title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $course->short_description }}
                            </p>
                            
                            <div class="flex gap-4 text-sm text-gray-500 mb-4 pb-4 border-b">
                                <span>📚 {{ $course->lessons->count() }} lessons</span>
                                <span>👥 {{ $course->enrollments->count() }} students</span>
                            </div>

                            <a href="{{ route('courses.show', $course->id) }}" 
                               class="block text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                View Course
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($courses->hasPages())
                <div class="mt-8">
                    {{ $courses->links() }}
                </div>
            @endif
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-16">
        <div class="max-w-7xl mx-auto px-6 py-6">
            <p class="text-center text-gray-500 text-sm">
                © {{ date('Y') }} Simple LMS. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>