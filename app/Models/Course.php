<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'catalogue_id', 'catalogue', 'image', 'type', 'content', 'description', 'meta_title', 'meta_description', 'image_json', 'userid_created', 'userid_updated', 'created_at', 'updated_at', 'publish', 'order', 'alanguage', 'products'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid_created');
    }
    public function relationships()
    {
        return $this->hasMany(course_relationships::class, 'moduleid');
    }
    public function catalogues()
    {
        return $this->hasOne(CategoryArticle::class, 'id', 'catalogue_id');
    }
    public function tags()
    {
        return $this->hasMany(Tags_relationship::class, 'module_id', 'id')->where('module', '=', 'courses');
    }
    public function getTags()
    {
        return $this->hasMany(Tags_relationship::class, 'module_id', 'id')->where('tags_relationships.module', '=', 'articles')->join('tags', 'tags.id', '=', 'tags_relationships.tag_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'module_id', 'id')->where('module', '=', 'articles')->where('parentid', 0)->get();
    }

    public function fields()
    {
        return $this->hasMany(ConfigPostmeta::class, 'module_id')->where(['module' => 'courses'])->select('module_id', 'meta_key', 'meta_value');
    }
    
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function($q) use ($keyword) {
            $q->where('title', 'LIKE', "%{$keyword}%");
        });
    }
    public function getTotal()
    {
        return $this->hasMany(course_relationships::class, 'moduleid');
    }

    public function videos()
    {
        return $this->hasMany(CourseVideo::class, 'course_id');
    }

}
