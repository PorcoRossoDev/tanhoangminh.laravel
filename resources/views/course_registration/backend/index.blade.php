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
// dd($module);
echo breadcrumb_backend($array);
?>
@endsection
@section('content')
<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Danh sách khóa học đăng ký
    </h1>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class=" col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            @include('components.search',['module'=>$module,'htmlOption' => $htmlOption,'configIs' => $configIs])
            @can('course_registrations_create')
            <a href="{{route('course_registrations.create')}}" class="btn btn-primary shadow-md mr-2">Thêm mới</a>
            @endcan
        </div>
        <!-- BEGIN: Data List -->
        <div class=" col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        @can('course_registrations_destroy')
                        <th style="width:40px;">
                            <input type="checkbox" id="checkbox-all">
                        </th>
                        @endcan
                        <th>STT</th>
                        <th>KHÓA HỌC</th>
                        <th>KHÁCH KHÀNG</th>
                        <th>NGƯỜI TẠO</th>
                        <th>NGÀY TẠO</th>
                        @include('components.table.is_thead')
                        <th>#</th>
                    </tr>
                </thead>
                <tbody id="table_data" role="alert" aria-live="polite" aria-relevant="all">
                    @if( $data )
                        @foreach($data as $v)
                        <tr class="odd " id="post-<?php echo $v->id; ?>">
                            @can('course_registrations_destroy')
                            <td>
                                <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item">
                            </td>
                            @endcan
                            <td>
                                {{$data->firstItem()+$loop->index}}
                            </td>
                            <td class="">
                                @if( $v->course )
                                    {{$v->course->title}}
                                @endif
                            </td>
                            <td>
                                @if( $v->customer )
                                    {{$v->customer->name}}
                                    <br>
                                    {{$v->customer->email}}
                                @endif
                            </td>
                            <td class="">
                                @if( $v->user )
                                    {{$v->user->name}}
                                @endif
                            </td>
                            <td>
                                @if($v->created_at)
                                {{Carbon\Carbon::parse($v->created_at)->diffForHumans()}}
                                @endif
                            </td>
                            @include('components.table.is_tbody')
                            <td class="table-report__action w-56 ">
                                <div class="flex justify-center items-center">
                                    @can('course_registrations_edit')
                                    <a class="flex items-center mr-3" href="{{ route('course_registrations.edit',['id'=>$v->id]) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                        Edit
                                    </a>
                                    @endcan
                                    @can('course_registrations_destroy')
                                    <a class="flex items-center text-danger ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa bài viết, bài viết sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                    </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        @if( $data )
        <!-- BEGIN: Pagination -->
        <div class=" col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center">
            {{$data->links()}}
        </div>
        <!-- END: Pagination -->
         @endif
    </div>
</div>
@endsection