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
}