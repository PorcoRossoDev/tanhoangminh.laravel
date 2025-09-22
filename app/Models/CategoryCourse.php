<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'parentid', 'description', 'image', 'image_json', 'type', 'isservice', 'meta_title', 'meta_description', 'userid_created', 'userid_updated', 'created_at', 'updated_at', 'publish', 'order', 'alanguage', 'banner'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid_created');
    }
    public function listCource()
    {
        return $this->hasMany(course_relationships::class, 'catalogueid')->where('module', '=', 'courses');
    }
    public function courses()
    {
        return $this->hasMany(Article::class, 'catalogue_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(CategoryArticle::class, 'parentid', 'id')->select('id', 'title', 'slug', 'parentid')->orderBy('order', 'asc')->orderBy('id', 'desc');
    }
    public function posts()
    {
        return $this->hasMany(course_relationships::class, 'catalogueid')->where('module', '=', 'courses')
            ->join('courses', 'courses.id', '=', 'course_relationships.moduleid')
            ->where(['courses.publish' => 0])
            ->select('courses.id', 'courses.title', 'courses.slug', 'courses.description', 'courses.image', 'courses.created_at', 'course_relationships.catalogueid')
            ->orderBy('courses.order', 'asc')->orderBy('courses.id', 'desc');
    }
    public function postsFields()
    {
        return $this->hasMany(course_relationships::class, 'catalogueid')->where('course_relationships.module', '=', 'courses')
            ->join('courses', 'courses.id', '=', 'course_relationships.moduleid')
            ->join('config_postmetas', 'course_relationships.moduleid', '=', 'config_postmetas.module_id')
            ->where(['courses.publish' => 0, 'config_postmetas.module' => 'courses'])
            ->select('courses.id', 'courses.title', 'courses.slug', 'courses.image', 'course_relationships.catalogueid', 'config_postmetas.meta_value')
            ->orderBy('courses.order', 'asc')->orderBy('courses.id', 'desc');
    }
}
