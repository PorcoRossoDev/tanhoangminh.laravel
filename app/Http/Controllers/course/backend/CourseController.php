<?php

namespace App\Http\Controllers\course\backend;

use App\Components\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseVideo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Components\Helper;
use App\Components\Polylang;
use App\Models\CategoryCourse;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    protected $Nestedsetbie;
    protected $Helper;
    protected $Polylang;
    protected $table = 'courses';
    public function __construct()
    {
        $this->Nestedsetbie = new Nestedsetbie(array('table' => 'category_courses'));
        $this->Helper = new Helper();
        $this->Polylang = new Polylang();
    }
    public function index(Request $request)
    {
        $module = $this->table;
        $data =  Course::where(['alanguage' => config('app.locale')])
            ->with('user:id,name')
            ->with(['relationships' => function ($query) {
                $query->select('course_relationships.moduleid', 'category_courses.title', 'category_courses.id')
                    ->where('module', '=', $this->table)
                    ->join('category_courses', 'category_courses.id', '=', 'course_relationships.catalogueid');
            }])
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'DESC');
        $keyword = $request->keyword;
        $catalogueid = $request->catalogueid;
        $type = $request->type;
        if (!empty($keyword)) {
            $data =  $data->where($this->table . '.title', 'like', '%' . $keyword . '%');
        }
        if (!empty($type)) {
            $data =  $data->where($this->table . '.' . $type,  1);
        }
        $data = $data->join('course_relationships', $this->table . '.id', '=', 'course_relationships.moduleid')->where('course_relationships.module', '=', $this->table);
        if (!empty($catalogueid)) {
            $data =  $data->where('course_relationships.catalogueid', $catalogueid);
        }
        $data =  $data->select('courses.id', 'courses.image', 'courses.title', 'courses.slug', 'courses.catalogue_id', 'courses.userid_created', 'courses.created_at', 'courses.publish', 'courses.order', 'courses.ishome', 'courses.highlight', 'courses.isaside', 'courses.isfooter');
        $data =  $data->groupBy('course_relationships.moduleid');
        $data =  $data->paginate(env('APP_paginate'));
        if (is($type)) {
            $data->appends(['type' => $type]);
        }
        if (is($keyword)) {
            $data->appends(['keyword' => $keyword]);
        }
        if (is($catalogueid)) {
            $data->appends(['catalogueid' => $catalogueid]);
        }
        $htmlOption = $this->Nestedsetbie->dropdown([], config('app.locale'));
        $configIs = \App\Models\Configis::select('title', 'type')->where(['module' => $this->table, 'active' => 1])->get();
        return view('course.backend.course.index', compact('data', 'module', 'htmlOption', 'configIs'));
    }
    public function create()
    {
        $dropdown = getFunctions();
        $module = $this->table;
        $action = 'create';
        $htmlCatalogue = $this->Nestedsetbie->dropdown([], config('app.locale'));
        //tags
        $getTags = [];
        if (old('tags')) {
            $getTags = old('tags');
        }
        // $tags = relationships('\App\Models\Tag', $getTags);
        //end tag
        $tags = Tag::select('id', 'title')->where('module', 'courses')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        $products = dropdown(\App\Models\Product::select('id', 'title')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get(), 'Chọn sản phẩm', 'id', 'title');
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        return view('course.backend.course.create', compact('module', 'htmlCatalogue', 'tags', 'dropdown', 'getTags', 'action', 'field', 'products'));
    }
    public function store(PostRequest $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     // 'slug' => 'required|unique:router,slug,' . config('app.locale') . ',alanguage',
        //     'slug' =>  ['required', Rule::unique('router')->where(function ($query) use ($request) {
        //         return $query->where('alanguage', config('app.locale'));
        //     })],
        //     'catalogue_id' => 'required|gt:0',
        // ], [
        //     'title.required' => 'Tiêu đề là trường bắt buộc.',
        //     'slug.required' => 'Đường dẫn khóa học là trường bắt buộc.',
        //     'slug.unique' => 'Đường dẫn khóa học đã tồn tại.',
        //     'catalogue_id.gt' => 'Danh mục là trường bắt buộc.',
        // ]);
        if (!empty($request->file('image'))) {
            $image_url = uploadImageNone($request->file('image'), 'courses');
        } else {
            $image_url = $request->image_old;
        }
        $this->submit($request, 'create', 0, $image_url);
        return redirect()->route('courses.index')->with('success', "Thêm mới khóa học thành công");
    }
    public function edit($id)
    {
        $dropdown = getFunctions();
        $module = $this->table;
        $action = 'update';
        $detail  = Course::where('alanguage', config('app.locale'))->find($id);
        if (!isset($detail)) {
            return redirect()->route('courses.index')->with('error', "Khóa học không tồn tại");
        }
        $videos = CourseVideo::where('course_id', $id)->get();
        $htmlCatalogue = $this->Nestedsetbie->dropdown([], config('app.locale'));
        //tags
        $getTags = [];
        if (old('tags')) {
            $getTags = old('tags');
        } else {
            foreach ($detail->tags as $k => $v) {
                $getTags[] = $v['tag_id'];
            }
        }
        $tags = Tag::select('id', 'title')->where('module', 'courses')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        // $tags = relationships('\App\Models\Tag', $getTags);
        //end tag
        $getCatalogue = [];
        $getProduct = [];
        if (old('catalogue')) {
            $getCatalogue = old('catalogue');
        } else {
            $getCatalogue = json_decode($detail->catalogue);
        }
        if (old('products')) {
            $getProduct = old('products');
        } else {
            $getProduct = json_decode($detail->products);
        }
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        $products = dropdown(\App\Models\Product::select('id', 'title')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get(), 'Chọn sản phẩm', 'id', 'title');
        return view('course.backend.course.edit', compact('module', 'detail', 'htmlCatalogue', 'tags', 'dropdown', 'getTags', 'action', 'getCatalogue', 'field', 'products', 'getProduct', 'videos'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            // 'slug' => 'required|unique:router,slug,' . $id . ',moduleid,alanguage,' . config('app.locale') . '',
            'slug' => ['required', Rule::unique('router')->where(function ($query) use ($id) {
                return $query->where('moduleid', '!=', $id)->where('alanguage', config('app.locale'));
            })],
            'catalogue_id' => 'required|gt:0',
        ], [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'slug.required' => 'Đường dẫn là trường bắt buộc.',
            'slug.unique' => 'Đường dẫn đã tồn tại.',
            'catalogue_id.gt' => 'Danh mục chính là trường bắt buộc.',
        ]);
        //upload image
        if (!empty($request->file('image'))) {
            $image_url = uploadImage($request->file('image'), 'courses');
        } else {
            $image_url = $request->image_old;
        }
        //end
        $this->submit($request, 'update', $id, $image_url);
        return redirect()->route('courses.index')->with('success', "Cập nhập khóa học thành công");
    }
    
    public function submit($request = [], $action = '', $id = 0, $image_url = '')
    {
        if ($action == 'create') {
            $time = 'created_at';
            $user = 'userid_created';
        } else {
            $time = 'updated_at';
            $user = 'userid_updated';
        }
        //danh mục phụ
        $catalogue = $request['catalogue'];
        $tmp_catalogue[] = (int)$request['catalogue_id'];
        if (isset($catalogue)) {
            foreach ($catalogue as $v) {
                if ($v != 0 && $v != $request['catalogue_id']) {
                    $tmp_catalogue[] = (int)$v;
                }
            }
        }
        //lấy danh mục cha (nếu có)
        $detail = CategoryCourse::select('id', 'title', 'slug', 'lft')->where('id', $request['catalogue_id'])->first();
        // $breadcrumb = CategoryCourse::select('id', 'title')->where('alanguage', config('app.locale'))->where('lft', '<=', $detail->lft)->where('rgt', '>=', $detail->lft)->orderBy('lft', 'ASC')->orderBy('order', 'ASC')->get();
        // if ($breadcrumb->count() > 0) {
        //     foreach ($breadcrumb as $v) {
        //         $tmp_catalogue[] = $v->id;
        //     }
        // }
        $tmp_catalogue = array_unique($tmp_catalogue);
        if( $action == 'create' ){
            $albums = $this->uploadAlbum($request);
        }
        //end
        $_data = [
            'title' => $request['title'],
            'slug' => $request['slug'],
            'catalogue_id' => $request['catalogue_id'],
            'image' => $image_url,
            'description' => $request['description'],
            'content' => $request['content'],
            'catalogue' => json_encode($tmp_catalogue),
            'products' => json_encode($request['products']),
            'image_json' =>  !empty($albums) ? json_encode($albums) : '',
            'meta_title' => $request['meta_title'],
            'meta_description' => $request['meta_description'],
            'publish' => $request['publish'],
            'type' => $request['type'],
            $user => Auth::user()->id,
            $time => Carbon::now(),
            'alanguage' => config('app.locale'),
        ];
        if ($action == 'create') {
            $id = Course::insertGetId($_data);
        } else {
            Course::find($id)->update($_data);
        }
        $this->saveCourseVideo($request, $id);
        if (!empty($id)) {
            //xóa khi cập nhập
            if ($action == 'update') {
                //xóa bảng router
                DB::table('router')->where(['moduleid' => $id, 'module' => $this->table])->delete();
                //xóa catalogue_relationship
                DB::table('course_relationships')->where(['moduleid' => $id, 'module' => $this->table])->delete();
                //xóa tags_relationship
                DB::table('tags_relationships')->where(['module_id' => $id, 'module' => $this->table])->delete();
                //xóa custom fields
                DB::table('config_postmetas')->where(['module_id' => $id, 'module' => $this->table])->delete();
                $this->Polylang->insert($this->table, $request['language'], $id);
            }
            //thêm vào bảng catalogue_relationship
            $this->Helper->courses_relation_ship($id, $request['catalogue_id'], $tmp_catalogue, $this->table);
            //thêm tag
            $this->Helper->tags_relationships($id, $request['tags'], $this->table);
            //thêm router
            DB::table('router')->insert([
                'moduleid' => $id,
                'module' => $this->table,
                'slug' => $request['slug'],
                'created_at' => Carbon::now(),
                'alanguage' => config('app.locale'),
            ]);
            //START: custom fields
            fieldsInsert($this->table, $id, $request);
            //END
        }
    }

    public function check( PostRequest $request ){
        $params = $request->validated();
    }

    public function saveCourseVideo($request, $course_id = 0)
    {
        $groups = $request->groups;
        $type = $request->type;
        CourseVideo::where('course_id', $course_id)->delete();
        if( isset($groups) && is_array($groups) && count($groups) ){
            foreach( $groups as $video ){
                if( count($video['blocks']) > 0 ){
                    foreach( $video['blocks'] as $item ){

                        $duration = 0;
                        if( $type == 'youtube' ){
                            $duration = $this->getDurationYoutube($item['link']);
                        }
                        if( $type == 'vimeo' ){
                            $duration = $this->getDurationVimeo($item['link']);
                        }

                        CourseVideo::create([
                            'title_group' => $video['name'],
                            'type_group' => $video['type'],
                            'course_id' => $course_id,
                            'name' => $item['title'],
                            'link' => $item['link'],
                            'duration' => $duration,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                            'userid_created' => Auth::user()->id,
                        ]);
                    }
                }
            }
        }
    }

    public function getDurationYoutube($url = '')
    {
        $html = Http::get($url)->body();

        $seconds = 0;
        // Lấy đoạn JSON ytInitialPlayerResponse
        if (preg_match('/ytInitialPlayerResponse\s*=\s*(\{.*?\});/s', $html, $matches)) {
            $json = json_decode($matches[1], true);

            $seconds = isset($json['videoDetails']['lengthSeconds'])
                ? (int) $json['videoDetails']['lengthSeconds']
                : null;

        }

        return $seconds;
    }

    public function getDurationVimeo($link = '')
    {
        $duration = 0;
        if (!empty($link)) {
            // Tách ID từ link https://player.vimeo.com/video/{id}
            preg_match('/\/video\/(\d+)/', $link, $matches);
            $videoId = $matches[1] ?? null;

            if ($videoId) { // ✅ có ID thì mới gọi API
                $apiUrl = "https://vimeo.com/api/oembed.json?url=https://vimeo.com/" . $videoId;
                $response = Http::get($apiUrl);

                if ($response->ok()) {
                    $data = $response->json();
                    // dd($data); // thử debug để xem trả về gì
                    $duration = $data['duration'] ?? 0;
                }
            }
        }
        return $duration;
    }

    public function uploadAlbum(Request $request, $id = 0)
    {
        $uploadedUrls = [];
        $slug = $request['slug'];
        if ($request->has('filepond')) {
            foreach ($request->input('filepond') as $fileJson) {
                $fileData = json_decode($fileJson, true);

                $base64 = $fileData['data'] ?? null;
                $name = $fileData['name'] ?? 'file_' . time();

                if ($base64) {
                    $data = base64_decode($base64);

                    // Tạo thư mục nếu chưa tồn tại
                    $uploadPath = base_path("uploads/{$slug}/albums");
                    if (!file_exists($uploadPath)) mkdir($uploadPath, 0755, true);

                    // Lưu file
                    $filePath = $uploadPath . '/' . $name;
                    file_put_contents($filePath, $data);

                    // Thêm URL vào mảng
                    $uploadedUrls[] = asset("uploads/{$slug}/albums/".$name);
                }
            }
        }
        // Trả về JSON danh sách đường dẫn ảnh
        return $uploadedUrls;
    }

    public function add_image(Request $request)
    {
        if (!$request->hasFile('filepond')) {
            return response()->json(['error' => 'Không có file upload'], 400);
        }

        $id = (int) $request->input('id');
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['error' => 'Course không tồn tại'], 404);
        }

        $slug = $course->slug;
        $uploadPath = base_path("uploads/{$slug}/albums");
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $files = $request->file('filepond'); // có thể là array hoặc 1 file
        if (!is_array($files)) {
            $files = [$files];
        }

        $uploadedUrls = [];
        foreach ($files as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);

            $url = asset("uploads/{$slug}/albums/" . $fileName);
            $uploadedUrls[] = $url;
        }

        // cập nhật vào DB (prepend để đưa ảnh mới lên đầu)
        $image_json = json_decode($course->image_json, true) ?? [];
        foreach (array_reverse($uploadedUrls) as $url) {
            array_unshift($image_json, $url);
        }
        $course->update([
            'image_json' => json_encode($image_json)
        ]);

        return response()->json([
            'success' => true,
            'urls'    => $uploadedUrls,
        ]);
    }


    // Ajax thực hiện xóa ảnh trong album
    public function delete_image(Request $request)
    {
        $url = $request->input('url'); // URL ảnh
        $id = (int)$request->input('id');

        $course = Course::find($id);
        $image_json = json_decode($course->image_json, true);

        if(!$url) return response()->json(['success' => false]);

        // Chuyển URL về path server
        $filePath = public_path(parse_url($url, PHP_URL_PATH));

        $relativePath = ltrim(parse_url($url, PHP_URL_PATH), '/'); 
        $path = base_path($relativePath);

        // Xóa ảnh trên folder và đường dẫn trên db
        if (File::exists($path)) {
            File::delete($path);

            $image_json = array_diff($image_json, [$url]);
            $course->update([
                'image_json' => json_encode(array_values($image_json))
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'File not found']);
    }



}
