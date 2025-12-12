<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class InstructorDashboardController extends Controller
{
    public function index()
    {
        // Get all courses with their counts
        $courses = Course::withCount(['lessons', 'enrollments'])
            ->latest()
            ->get();

        return view('instructor.dashboard', compact('courses'));
    }
}