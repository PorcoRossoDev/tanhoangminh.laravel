@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách bài viết</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách khóa học đăng ký",
        "src" => route('course_registrations.index'),
    ],
    [
        "title" => "Danh sách",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);

if ($errors->any()) {
    $customer_id = old('customer_id');
    $course_id = old('course_id');
}

if( isset($detail) ){
    $registration_time = \Carbon\Carbon::parse($detail->registration_time)->format('d-m-Y');
    $expiration_time = \Carbon\Carbon::parse($detail->expiration_time)->format('d-m-Y');
    $customer = isset($detail->customer_id) ? App\Models\Customer::find($detail->customer_id) : null;
    $course = isset($detail->course_id) ? App\Models\Course::find($detail->course_id) : null;
}
?>
@endsection
@section('content')
<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Danh sách khóa học đăng ký
    </h1>
    <div class="grid grid-cols-12 gap-6 mt-5 ">
        <div class=" col-span-12 lg:col-span-12">
            <div class=" box p-5">
                <form role="form" action="{{$actionForm}}" method="post" enctype="multipart/form-data">
                    @include('components.alert-error')
                    @csrf
                    <div class="tab-content">
                        <div id="example-tab-homepage" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-homepage-tab">
                            <div class="grid grid-cols-12 gap-4 mt-3">
                                <div class="col-span-12 flex items-center lg:col-span-2">
                                    <label class="form-label text-base font-semibold">Khách hàng</label>
                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <select id="customer_id" class="form-control w-full tom-select" name="customer_id" placeholder="Nhập từ 3 ký tự để tìm kiếm...">
                                        @if( isset($customer) )
                                            <option value="{{ $customer->id }}" selected>
                                                {{ $customer->name }} - {{ $customer->email }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 gap-4 mt-5">
                                <div class="col-span-12 flex items-center lg:col-span-2">
                                    <label class="form-label text-base font-semibold">Khóa học</label>
                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <select id="course_id" class="form-control w-full tom-select" name="course_id" placeholder="Nhập từ 3 ký tự để tìm kiếm...">
                                        @if( isset($course) )
                                            <option value="{{ $course->id }}" selected>
                                                {{ $course->title }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 gap-4 mt-5">
                                <div class="col-span-12 flex items-center lg:col-span-2">
                                    <label class="form-label text-base font-semibold">Ngày đăng ký <span class="text-danger text-sm">(dd/mm/YY)</span></label>
                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <?php echo Form::text('registration_time', (!empty($detail->registration_time)?$registration_time:''), ['class' => 'form-control w-full datpicker', 'id' => 'registration_time']); ?>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 gap-4 mt-5">
                                <div class="col-span-12 flex items-center lg:col-span-2">
                                    <label class="form-label text-base font-semibold">Ngày hết hạn <span class="text-danger text-sm">(dd/mm/YY)</span></label>
                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <?php echo Form::text('expiration_time', (!empty($detail->expiration_time)?$expiration_time:''), ['class' => 'form-control w-full datpicker', 'id' => 'expiration_time']); ?>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 gap-4 mt-5">
                                <div class="col-span-12 lg:col-span-6 text-right">
                                    <button type="submit" class="btn btn-primary w-24">Cập nhập</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@include('course_registration.backend.common')