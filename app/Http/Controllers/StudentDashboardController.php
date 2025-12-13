<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    /**
     * Display the student dashboard
     */
    public function index()
    {
        // Get all available courses with instructor, lessons count, and enrollments count
        $availableCourses = Course::with('instructor')
            ->withCount(['lessons', 'enrollments'])
            ->latest()
            ->get();

        // Get courses the student is enrolled in
        $enrolledCourses = Auth::user()->enrolledCourses()
            ->with('instructor')
            ->withCount(['lessons', 'enrollments'])
            ->latest()
            ->get();

        return view('student.dashboard', compact('availableCourses', 'enrolledCourses'));
    }

   public function enroll(Course $course)
{
    $student = auth()->user();
    
    // Check if already enrolled
    if ($student->enrolledCourses()->where('course_id', $course->id)->exists()) {
        return redirect()->back()->with('error', 'You are already enrolled in this course.');
    }
    
    // Enroll the student - create enrollment record
    $student->enrollments()->create([
        'course_id' => $course->id,
        'enrolled_at' => now(),
    ]);
    
    return redirect()->back()->with('success', 'Successfully enrolled in ' . $course->title . '!');
}

public function unenroll(Course $course)
{
    $student = auth()->user();
    
    // Check if enrolled
    $enrollment = $student->enrollments()->where('course_id', $course->id)->first();
    
    if (!$enrollment) {
        return redirect()->back()->with('error', 'You are not enrolled in this course.');
    }
    
    // Unenroll the student
    $enrollment->delete();
    
    return redirect()->back()->with('success', 'Successfully unenrolled from ' . $course->title . '.');
}
}