<?php

namespace App\Http\Controllers\course\frontend;

use App\Http\Controllers\Controller;
use App\Models\course;
use App\Models\CategoryCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cache;
use App\Components\Comment;
use App\Components\System;

class CourseController extends Controller
{
    protected $comment;
    protected $system;
    public function __construct()
    {
        $this->comment = new Comment();
        $this->system = new System();
    }
    public function index($slug = "")
    {
        $segments = request()->segments();
        $slug = end($segments);
        $detail = Course::select()
            ->where(['slug' => $slug, 'alanguage' => config('app.locale'), 'publish' => 0])
            ->with('catalogues')
            ->with('fields')
            ->first();
        if (!isset($detail)) {
            return redirect()->route('homepage.index');
        }
        $catalogues = $detail->catalogues;
        // breadcrumb
        $breadcrumb = CategoryCourse::select('title', 'slug')->where('alanguage', config('app.locale'))->where('lft', '<=', $catalogues->lft)->where('rgt', '>=', $catalogues->lft)->orderBy('lft', 'ASC')->orderBy('order', 'ASC')->get();
        //cập nhập lượt xem
        DB::table('courses')->where('id', '=', $detail['id'])->update([
            'viewed' => $detail['viewed'] + 1,
        ]);
        //lấy comment
        $comment_view =  $this->comment->comment(array('id' => $detail->id, 'sort' => 'id'), 'courses');
        $fcSystem = $this->system->fcSystem();
        $seo['canonical'] = route('routerURL', ['slug' => $slug]);
        $seo['meta_title'] =  !empty($detail['meta_title']) ? $detail['meta_title'] : $detail['title'];
        $seo['meta_description'] = !empty($detail['meta_description']) ? $detail['meta_description'] : cutnchar(strip_tags($detail->description));
        $seo['meta_image'] = $detail['image'];
        $fcSystem = $this->system->fcSystem();
        $module = 'courses';
        $polylang = langURLFrontend($module, config('app.locale'), $detail->id, '\App\Models\Course');
        if (!empty($polylang)) {
            foreach ($polylang as $key => $item) {
                $fcSystem['language_' . $key] = $item;
            }
        }
        return view('course.frontend.course.index', compact('module', 'fcSystem', 'detail', 'seo', 'breadcrumb', 'catalogues', 'comment_view'));
    }
}
