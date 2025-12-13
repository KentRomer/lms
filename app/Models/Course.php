<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'short_description',
        'content',
        'thumbnail',
    ];

    // Relationship: A course belongs to an instructor (user)
    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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

    // Relationship: A course has many students through enrollments
    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }

    // Relationship: A course can be bookmarked by many users
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }
}