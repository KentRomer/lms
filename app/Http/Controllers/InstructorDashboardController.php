<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class InstructorDashboardController extends Controller
{
       public function index()
    {
        // Only get courses created by the currently authenticated instructor
        $courses = Course::where('user_id', auth()->id())
            ->withCount(['lessons', 'enrollments'])
            ->latest()
            ->get();

        return view('instructor.dashboard', compact('courses'));
    }
}