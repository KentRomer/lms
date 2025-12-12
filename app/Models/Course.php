<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'content',
        'thumbnail',
    ];

    // Relationship: A course has many lessons
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // Relationship: A course has many enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}