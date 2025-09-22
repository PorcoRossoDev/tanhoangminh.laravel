<?php

namespace App\Http\Controllers\course\frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CategoryCourse;
use Illuminate\Http\Request;
use App\Components\System;
use Cache;

class CategoryController extends Controller
{
    protected $paginate = 16;
    protected $system;
    public function __construct()
    {
        $this->system = new System();
    }
    public function index($slug = "", Request $request)
    {
        $segments = request()->segments();
        $slug = end($segments);

        $detail = CategoryCourse::select('id', 'slug', 'title', 'type', 'description', 'meta_description', 'meta_title', 'publish', 'lft', 'image', 'banner', 'ishome', 'highlight', 'isaside', 'isfooter', 'parentid')
            ->with('children')
            ->where('alanguage', config('app.locale'))
            ->where('publish', 0)
            ->where('slug', $slug)
            ->first();
        if (!isset($detail)) {
            return redirect()->route('homepage.index');
        }

        // Bài viết mới nhất
        $latestCourse = \App\Models\Course_relationships::where(['catalogueid' => $detail->id, 'module' => 'courses', 'courses.publish' => 0])
        ->join('courses', 'courses.id', '=', 'course_relationships.moduleid')
        ->with('postmetas')
        ->orderBy('courses.id', 'desc')->first();

        $data = \App\Models\Course_relationships::where(['catalogueid' => $detail->id, 'module' => 'courses', 'courses.publish' => 0])
            ->join('courses', 'courses.id', '=', 'course_relationships.moduleid')
            ->with('postmetas')
            ->with('videos')
            ->orderBy('courses.id', 'desc');

        $data = $data->paginate($this->paginate);
        
        // breadcrumb
        $breadcrumb = CategoryCourse::select('title', 'slug')->where('alanguage', config('app.locale'))->where('lft', '<=', $detail->lft)->where('rgt', '>=', $detail->lft)->orderBy('lft', 'ASC')->orderBy('order', 'ASC')->get();
        $seo['canonical'] = route('routerURL', ['slug' => $slug]);
        $seo['meta_title'] =  !empty($detail['meta_title']) ? $detail['meta_title'] : $detail['title'];
        $seo['meta_description'] = !empty($detail['meta_description']) ? $detail['meta_description'] : cutnchar(strip_tags($detail->description));
        $seo['meta_image'] = $detail['image'];
        $fcSystem = $this->system->fcSystem();
        $polylang = langURLFrontend('category_course', config('app.locale'), $detail->id, '\App\Models\CategoryCourse');
        if (!empty($polylang)) {
            foreach ($polylang as $key => $item) {
                $fcSystem['language_' . $key] = $item;
            }
        }
        return view('course.frontend.category.index', compact('fcSystem', 'detail', 'seo', 'data', 'breadcrumb', 'latestCourse'));
    }
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $month = $request->month;
        $sort = '';
        if (!empty($_GET['sort'])) {
            $sort = $_GET['sort'];
        }
        $data =  Article::select('id', 'title', 'description', 'image', 'slug', 'userid_created', 'created_at')->where(['alanguage' => config('app.locale'), 'publish' => 0]);
        if (!empty($keyword)) {
            $data =  $data->where('title', 'like', '%' . $keyword . '%');
        }
        if (!empty($month)) {
            $data =  $data->whereMonth('created_at', $month);
        }
        $data =  $data->orderBy('order', 'asc')->orderBy('id', 'desc');
        $data =  $data->paginate(12);
        if (is($keyword)) {
            $data->appends(['keyword' => $keyword]);
        }
        $seo['canonical'] = $request->url();
        $seo['meta_title'] =  "Search " . $keyword;
        $seo['meta_description'] = '';
        $seo['meta_image'] = '';
        $fcSystem = $this->system->fcSystem();
        return view('course.frontend.search.index', compact('fcSystem', 'seo', 'data'));
    }
    public function ajaxPagination(Request $request)
    {
        $id = $request->id;
        $data = \App\Models\Course_relationships::where(['catalogueid' => $id, 'module' => 'course', 'course.publish' => 0])
            ->join('course', 'course.id', '=', 'course_relationships.moduleid')
            ->orderBy('course.id', 'desc')
            ->paginate($this->paginate);
        return view('course.frontend.category.data', compact('data'))->render();
    }
}
