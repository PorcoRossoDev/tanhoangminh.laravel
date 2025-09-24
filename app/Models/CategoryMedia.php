<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Model;

class CategoryMedia extends Model
{
    // use HasEagerLimit;
    use HasFactory;
    protected $fillable = ['alanguage','title','slug','description','image','parentid','level','lft','rgt','publish','ishome','highlight','isaside','isfooter'
    ,'order','meta_title', 'meta_description', 'userid_created','userid_updated','created_at','updated_at','layoutid'];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid_created');
    }
    public function listMedia()
    {
        return $this->hasMany(Catalogues_relationships::class, 'catalogueid')->where('module', '=', 'media')
            ->join('media', 'media.id', '=', 'catalogues_relationships.moduleid')
            ->where(['media.publish' => 0])
            ->select('media.id', 'media.title', 'media.slug', 'media.description', 'media.image', 'media.video_iframe', 'media.created_at', 'catalogues_relationships.catalogueid')
            ->orderBy('media.order', 'asc')->orderBy('media.id', 'desc')
            ->limit(2);
    }
    public function children()
    {
        return $this->hasMany(CategoryMedia::class, 'parentid','id')->orderBy('order','asc')->orderBy('id','desc');
    }
    public function fields()
    {
        return $this->hasMany(ConfigPostmeta::class, 'module_id')->where(['module' => 'category_media'])->select('module_id', 'meta_key', 'meta_value');
    }
}
