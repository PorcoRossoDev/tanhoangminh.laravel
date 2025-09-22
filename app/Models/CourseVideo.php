<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseVideo extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title_group', 'type_group', 'name', 'link', 'duration', 'description', 'userid_created'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    
}
