<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function create(Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized Action: You are not the instructor who made this course.');
        }

        return view('instructor.Lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized Action: You are not the instructor who made this course.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $validated['course_id'] = $course->id;
        $validated['order'] = $course->lessons()->count() + 1;

        Lesson::create($validated);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Lesson added successfully!');
    }

    public function edit(Course $course, Lesson $lesson)
    {
        if ($course->user_id !== Auth::id() || $lesson->course_id !== $course->id) {
            return redirect()->back()->with('error', 'Unauthorized Action: You are not the instructor who made this course.');
        }

        return view('instructor.Lessons.edit', compact('course', 'lesson'));
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        if ($course->user_id !== Auth::id() || $lesson->course_id !== $course->id) {
            return redirect()->back()->with('error', 'Unauthorized Action: You are not the instructor who made this course.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $lesson->update($validated);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Lesson updated successfully!');
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        if ($course->user_id !== Auth::id() || $lesson->course_id !== $course->id) {
            return redirect()->back()->with('error', 'Unauthorized Action: You are not the instructor who made this course.');
        }

        $lesson->delete();

        return redirect()->route('courses.show', $course)
            ->with('success', 'Lesson deleted successfully!');
    }
}