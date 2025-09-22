<?php

namespace App\Http\Controllers\course_registration\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CourseRegistration;

class CourseRegistrationController extends Controller
{
    protected $table = 'course_registrations';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $data = CourseRegistration::orderBy('id', 'desc')->with(['user', 'customer', 'course']);
        $data = $data->when($keyword, function($q) use ($keyword) {
            $q->whereHas('course', function($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%");
            });
        });
        $data = $data->paginate(env('APP_paginate'));
        $htmlOption = [];
        $configIs = \App\Models\Configis::select('title', 'type')->where(['module' => $this->table, 'active' => 1])->get();
        $module = 'course_registrations';
        return view('course_registration.backend.index', compact('module', 'htmlOption', 'configIs', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $actionForm = route("course_registrations.store");
        $module = $this->table;
        return view('course_registration.backend.form', compact('module', 'actionForm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|gt:0',
            'course_id' => 'required|gt:0',
            'registration_time' => 'required',
            'expiration_time' => 'required',
        ], [
            'customer_id.required' => 'Khách hàng là bắt buộc.',
            'course_id.required' => 'Khóa học là bắt buộc.',
            'registration_time.required' => 'Ngày đăng ký là bắt buộc.',
            'expiration_time.required' => 'Ngày hết hạn là bắt buộc.',
        ]);
        $this->submit($request, 'create', 0);
        return redirect()->route('course_registrations.index')->with('success', "Đăng ký khóa học thành công");
    }

    public function submit($request, $action = 'create', $id = 0)
    {
        if ($action == 'create') {
            $user = 'userid_created';
        } else {
            $user = 'userid_updated';
        }
        $_data = [
            'customer_id' => $request['customer_id'],
            'course_id' => $request['course_id'],
            'registration_time' => Carbon::createFromFormat('d-m-Y', $request['registration_time'])->format('Y-m-d'),
            'expiration_time' => Carbon::createFromFormat('d-m-Y', $request['expiration_time'])->format('Y-m-d'),
            $user => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        if ($action == 'create') {
            $_data['userid_updated'] = Auth::user()->id;
            $id = CourseRegistration::insertGetId($_data);
        } else {
            CourseRegistration::find($id)->update($_data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = CourseRegistration::find($id);
        if (!isset($detail)) {
            return redirect()->route('course_registrations.index')->with('error', "Mục đăng ký không tồn tại");
        }
        $actionForm = route("course_registrations.update", ['id' => $id]);
        $module = $this->table;
        $action = 'update';
        return view('course_registration.backend.form', compact('module', 'actionForm', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Tìm kiếm khách hàng
    public function ajaxSearchCustomer(Request $request)
    {
        $keyword = $request->q;
        $customers = \App\Models\Customer::search($keyword)->get();

        $result = $customers->map(function($customer){
            return [
                'value' => $customer->id,
                'text'  => $customer->name . ' - ' . $customer->email,
            ];
        });
        return response()->json($result);
    }
    
    // Tìm kiếm khóa học
    public function ajaxSearchCourse(Request $request)
    {
        $keyword     = $request->keyword;
        $customer_id = (int) $request->customer_id;

        // Query cơ bản
        $query = \App\Models\Course::query();

        // Nếu có keyword thì search
        if ($keyword) {
            $query->where('title', 'like', "%{$keyword}%");
        }

        // Nếu có customer_id thì loại bỏ course đã đăng ký
        if ($customer_id) {
            $registeredCourseIds = \App\Models\CourseRegistration::where('customer_id', $customer_id)
                ->pluck('course_id')
                ->toArray();
            if (!empty($registeredCourseIds)) {
                $query->whereNotIn('id', $registeredCourseIds);
            }
        }

        $courses = $query->limit(20)->get();

        $result = $courses->map(function ($course) {
            return [
                'value' => $course->id,
                'text'  => $course->title,
            ];
        });

        return response()->json($result);
    }

}
