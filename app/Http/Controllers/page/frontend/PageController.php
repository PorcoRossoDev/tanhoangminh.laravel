<?php

namespace App\Http\Controllers\page\frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Article;
use App\Models\Examination;
use App\Models\CategoryAttribute;
use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Components\System;
use App\Models\Orders_item;
use Carbon\Carbon;
use Validator;
use App\Models\Tag;
use App\Models\Tags_relationship;

class PageController extends Controller
{
    protected $system;
    public function __construct()
    {
        $this->system = new System();
    }
    public function aboutUs()
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'aboutus', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        $listExpert = Expert::where(['alanguage' => config('app.locale'), 'highlight' => '1', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->get();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.aboutus', compact('seo', 'page', 'fcSystem', 'fields', 'listExpert'));
    }
    
    public function experts(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'experts', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        // Lấy ra thuộc tính lọc từ url
        $filters = $request->filters;
        $filters = !empty($filters) ? array_unique(explode('-',$filters)) : [];
        
        // Danh sách lọc
        $listAttribute = CategoryAttribute::where(['alanguage' => config('app.locale'), 'publish' => 0])->with('listAttr')->orderBy('order', 'ASC')->orderBy('id', 'desc')->get();   
        
        $data = Expert::select('id', 'title', 'slug', 'image', 'description',  'experts.created_at')
        ->join('experts_attributes_relationships', 'experts.id', '=', 'experts_attributes_relationships.expert_id')
        
        ->where('alanguage', config('app.locale'))->where('experts.publish', 0)
        ->with(['attributes'])
        ->groupBy('experts.id');
        if( !empty($filters) ){
            $data = $data->whereIn('experts_attributes_relationships.attribute_id', $filters);
        }
        $data = $data->orderBy('order', 'ASC')->orderBy('experts.id', 'desc')->paginate(2);

        if (is($filters)) {
            $data->appends(['filters' => join('-', $filters)]);
        }

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.experts', compact('seo', 'page', 'fcSystem', 'fields', 'data', 'listAttribute', 'filters'));
    }
    
    public function history(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'history', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.history', compact('seo', 'page', 'fcSystem', 'fields'));
    }
    
    public function officer(Request $request)
    {

        $tags = Tag::where(['alanguage' => config('app.locale'), 'highlight' => 1, 'publish' => 0])
        ->with(['experts' => function($q) {
            $q->with('fields');
        }])
        ->orderBy('order', 'asc')
        ->orderBy('id', 'desc')->get();

        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'officer', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.officer', compact('seo', 'page', 'fcSystem', 'fields', 'tags'));
    }
    
    public function responsibility(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'responsibility', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.responsibility', compact('seo', 'page', 'fcSystem', 'fields'));
    }
    
    public function realty(Request $request)
    {
        $fcSystem = $this->system->fcSystem();
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'realty', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        $id_bds = !empty($fcSystem['bds_0']) ? json_decode($fcSystem['bds_0'], true) : 0;
        $bds = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'image', 'description')
        ->where(['alanguage' => config('app.locale'), 'publish' => 0])
        ->whereIn('id', $id_bds)
        ->with(['posts'])
        ->orderBy('order', 'asc')
        ->get();

        $id_news = !empty($fcSystem['bds_1']) ? json_decode($fcSystem['bds_1'], true) : 0;
        $news = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'image', 'description')
        ->where(['alanguage' => config('app.locale'), 'publish' => 0])
        ->whereIn('id', $id_news)
        ->with(['posts'])
        ->orderBy('order', 'asc')
        ->get();

        $id_noibat = !empty($fcSystem['bds_2']) ? json_decode($fcSystem['bds_2'], true) : 0;
        $noibat = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'image', 'description')
        ->where(['alanguage' => config('app.locale'), 'publish' => 0])
        ->whereIn('id', $id_noibat)
        ->with(['posts'])
        ->orderBy('order', 'asc')
        ->get();

        $id_kinhdoanh = !empty($fcSystem['bds_3']) ? json_decode($fcSystem['bds_3'], true) : 0;
        $kinhdoanh = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'image', 'description')
        ->where(['alanguage' => config('app.locale'), 'publish' => 0])
        ->whereIn('id', $id_kinhdoanh)
        ->with(['posts'])
        ->orderBy('order', 'asc')
        ->get();

        $id_cohoi = !empty($fcSystem['bds_4']) ? json_decode($fcSystem['bds_4'], true) : 0;
        $cohoi = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'image', 'description')
        ->where(['alanguage' => config('app.locale'), 'publish' => 0])
        ->whereIn('id', $id_cohoi)
        ->with(['posts'])
        ->orderBy('order', 'asc')
        ->get();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        
        return view('page.frontend.realty', compact('seo', 'page', 'fcSystem', 'fields', 'bds', 'news', 'noibat', 'kinhdoanh', 'cohoi'));
    }
    
    public function thm_360(Request $request)
    {
        $fcSystem = $this->system->fcSystem();
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'thm_360', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }

        $id_noibat = !empty($fcSystem['thm360_0']) ? json_decode($fcSystem['thm360_0'], true) : 0;
        $noibat = null;
        if( $id_noibat ){
            $noibat = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'image', 'description')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0])
            ->whereIn('id', $id_noibat)
            ->with(['posts'])
            ->orderBy('order', 'asc')
            ->get();
        }

        $id_zoom = !empty($fcSystem['thm360_1']) ? json_decode($fcSystem['thm360_1'], true) : 0;
        $th_zoom = null;
        if( $id_zoom ){
            $th_zoom = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'image', 'description')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0])
            ->whereIn('id', $id_zoom)
            ->with(['posts'])
            ->orderBy('order', 'asc')
            ->get();
        }

        $id_edu = !empty($fcSystem['thm360_2']) ? json_decode($fcSystem['thm360_2'], true) : 0;
        $th_edu = null;
        if( $id_edu ){
            $th_edu = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'image', 'description')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0])
            ->whereIn('id', $id_edu)
            ->with(['posts'])
            ->orderBy('order', 'asc')
            ->get();
        }

        $id_leauge = !empty($fcSystem['thm360_3']) ? json_decode($fcSystem['thm360_3'], true) : 0;
        $th_leauge = null;
        if( $id_leauge ){
            $th_leauge = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'image', 'description')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0])
            ->whereIn('id', $id_leauge)
            ->with(['posts'])
            ->orderBy('order', 'asc')
            ->get();
        }

        $id_sport = !empty($fcSystem['thm360_4']) ? json_decode($fcSystem['thm360_4'], true) : 0;
        $th_sport = null;
        if( $id_sport ){
            $th_sport = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'image', 'description')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0])
            ->whereIn('id', $id_sport)
            ->with(['posts'])
            ->orderBy('order', 'asc')
            ->get();
        }


        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        
        return view('page.frontend.thm_360', compact('seo', 'page', 'fcSystem', 'fields', 'noibat', 'th_zoom', 'th_edu', 'th_leauge', 'th_sport'));
    }
    
    public function scheduleSampling(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'schedule_sampling', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        // Lấy tỉnh thành phố
        $getCity = getListCity();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.schedule_sampling', compact('seo', 'page', 'fcSystem', 'fields', 'getCity'));
    }
    
    public function finding(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'finding', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        $detail = null;
        $error = false;
        $view = 'page.frontend.fidding';
        if( !empty($request->examination_date) && !empty($request->examination_code) && !empty($request->examination_pass) ) {
            $date = join('-', array_reverse(explode(' / ', $request->examination_date), true)) .' 00:00:00';
            $detail = Examination::where(['examination_date' => $date, 'examination_code' => $request->examination_code, 'examination_pass' => $request->examination_pass])->first();
            
            if( isset($detail) ) {
                $view = 'page.frontend.fidding_result';
            } else {
                $error = true;
            }            
        }

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view($view, compact('seo', 'page', 'fcSystem', 'fields', 'detail', 'error'));
    }
    
    public function scheduleAnAppointment(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'schedule_an_appointment', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        // Lấy tỉnh thành phố
        $getCity = getListCity();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.schedule_an_appointment', compact('seo', 'page', 'fcSystem', 'fields', 'getCity'));
    }

    public function tablePrice()
    {
        //page: Table Price
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'table_price', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();
        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.tablePrice', compact('seo', 'page', 'fcSystem', 'fields'));
    }
    public function agency()
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'agency', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();
        $article = Article::where(['alanguage' => config('app.locale'), 'isagency' => 1, 'publish' => 0])->get();
        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = $item->meta_value;
            }
        }

        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.agency', compact('seo', 'page', 'fcSystem', 'fields', 'article'));
    }
    public function reviews()
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'reviews', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();
        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = $item->meta_value;
            }
        }
        $data = \App\Models\Comment::where(['parentid' => 0, 'module' => 'products', 'publish' => 0])
            ->orderBy('id', 'desc')
            ->paginate(30);
        if (!empty($data)) {
            foreach ($data as $key => $item) {
                $checkOrder = \App\Models\Orders_item::where(['product_id' => $item->module_id, 'customer_id' => $item->customerid])->first();
                $data[$key]['checkOrder'] = !empty($checkOrder) ? 1 : 0;
            }
        }
        $ratings = \App\Models\Comment::where(['parentid' => 0, 'module' => 'products'])->sum('rating');
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.reviews', compact('seo', 'page', 'fcSystem', 'fields', 'data', 'ratings'));
    }
}
