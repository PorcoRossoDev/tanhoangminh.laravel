<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'module', 'slug', 'description', 'image', 'meta_title', 'meta_description', 'userid_created', 'created_at', 'publish', 'order', 'userid_updated', 'updated_at', 'alanguage', 'isProduct', 'isTour', 'isArticle'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid_created');
    }

    public function tagExperts()
    {
        return $this->hasMany(Tags_relationship::class, 'tag_id')
            ->where('module', 'experts');
    }

    public function experts()
    {
        return $this->belongsToMany(
            Expert::class,            // model liên kết
            'tags_relationships',     // bảng trung gian
            'tag_id',                 // khóa ngoại của Tag trong bảng trung gian
            'module_id'               // khóa ngoại của Expert trong bảng trung gian
        )
        ->wherePivot('module', 'experts')
        ->where('experts.publish', 0)
        ->orderBy('experts.order', 'asc')
        ->orderBy('experts.id', 'desc');
    }
}
