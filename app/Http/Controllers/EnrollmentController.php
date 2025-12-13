<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Enroll a student in a course
     */
    public function enroll(Course $course)
    {
        // Check if already enrolled
        $existingEnrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // Create enrollment
        Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Successfully enrolled in ' . $course->title . '!');
    }

    /**
     * Unenroll a student from a course
     */
    public function unenroll(Course $course)
    {
        // Find and delete the enrollment
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return redirect()->back()->with('error', 'You are not enrolled in this course.');
        }

        $enrollment->delete();

        return redirect()->route('student.dashboard')->with('success', 'Successfully unenrolled from ' . $course->title . '.');
    }
}