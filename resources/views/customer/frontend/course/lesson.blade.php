@extends('homepage.layout.home')
@section('content')
    <div class="main-page">
        <div class="container">
            <div class="content-page">

                <div class="bg-[#f5f5f5] flex items-center px-3 py-2.5 border-1 border-[#ddd]">
                    <img class="h-6 mr-1 w-6" src="http://ezdaily.laravel/frontend/images/book-alt.svg" alt="">
                    <span class="font-black text-f20">我的課程</span>
                </div>
                <div class="px-4 pt-2.5 pb-8 border-1 border-[#ddd]">
                    <div class="flex justify-content-end mt-4">
                        <form action="" class="flex w-1/3">
                            <input type="text" name="keyword" value="{{ request()->keyword }}" class="form-control h-11" placeholder="教材搜索">
                            <button type="submit" class="bg-black px-3 h-11">
                                <svg width="22px" height="22px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>search</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-256.000000, -1139.000000)" fill="#ffffff"> <path d="M269.46,1163.45 C263.17,1163.45 258.071,1158.44 258.071,1152.25 C258.071,1146.06 263.17,1141.04 269.46,1141.04 C275.75,1141.04 280.85,1146.06 280.85,1152.25 C280.85,1158.44 275.75,1163.45 269.46,1163.45 L269.46,1163.45 Z M287.688,1169.25 L279.429,1161.12 C281.591,1158.77 282.92,1155.67 282.92,1152.25 C282.92,1144.93 276.894,1139 269.46,1139 C262.026,1139 256,1144.93 256,1152.25 C256,1159.56 262.026,1165.49 269.46,1165.49 C272.672,1165.49 275.618,1164.38 277.932,1162.53 L286.224,1170.69 C286.629,1171.09 287.284,1171.09 287.688,1170.69 C288.093,1170.3 288.093,1169.65 287.688,1169.25 L287.688,1169.25 Z" id="search" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                            </button>
                        </form>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-10">
                        @if( isset($data) && count($data) )
                            @foreach( $data as $lesson )
                                @php
                                    $totalSeconds = $lesson->videos->sum('duration');
                                    $hours   = floor($totalSeconds / 3600);
                                    $minutes = floor(($totalSeconds % 3600) / 60);
                                    $totalDuration = $hours . 'hr ' . $minutes . 'min';
                                @endphp
                                <div class="lg:col-span-4 md:col-span-6 col-span-12 item">
                                    <div class="thumb">
                                        <img src="https://ezacademy.net/uploads/images/banner/topik1-by-bona-(1).jpg" alt="">
                                    </div>
                                    <div class="box-text p-3">
                                        <div class="flex justify-between mb-3">
                                            <span class="flex items-center whitespace-nowrap">
                                                <img class="h-4 w-4" src="{{ asset('frontend/images/book-alt.svg') }}" alt="">
                                                <span class="ml-1 text-black text-f14">{{ $lesson->videos_count }} {{ trans('index.Lesson') }}</span>
                                            </span>
                                            <span class="flex items-center whitespace-nowrap">
                                                <img src="{{ asset('frontend/images/clock-time.svg') }}" alt="" class="h-4 w-4">
                                                <span class="ml-1 text-black text-f14">{{ $totalDuration }}</span>
                                            </span>
                                        </div>
                                        <h3 class="mb-3">
                                            <a href="{{ route('customer.lesson_course', ['slug' => $lesson->slug]) }}" class="block font-medium text-f16" style="text-align: justify;overflow: hidden;text-overflow: ellipsis;-webkit-line-clamp: 2;-webkit-box-orient: vertical;display: -webkit-box;line-height: 23px;height: 46px;">
                                                {{ $lesson->title }}    
                                            </a>
                                        </h3>
                                        <div class="border-[#ddd] border-t flex items-center justify-between pt-3 hidden">
                                            <img class="w-[30px] h-[30px] rounded-full mr-15px" src="https://html.themewin.com/edurcok-preview-tailwind/edurock/assets/images/grid/grid_small_4.jpg" alt="">
                                            <span class="flex text-f15 font-medium">Micle Robin</span>
                                        </div>
                                        <div class="border-[#ebebeb] border-t flex items-center justify-between justify-content-end pt-3">
                                            <a href="{{ route('customer.lesson_course', ['slug' => $lesson->slug]) }}" class="bg-black flex items-center px-2 py-2 rounded-[25px] text-white whitespace-nowrap">
                                                <img class="brightness-0 contrast-200 h-4 invert ml-1 w-4" src="http://ezdaily.laravel/frontend/images/play-alt-1.svg" alt="" style="">
                                                <span class="ml-1 mr-2 text-f14">{{ trans('index.StartCourse') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-span-12">
                                {!! $data->links() !!}
                            </div>
                        @else
                            <div class="col-span-12">{{ trans('index.NoresultLesson') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('css')
<link rel="stylesheet" href="{{asset('frontend/css/app.css')}}"/>
<style>
    .item{
        box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
    }
</style>
@endpush

@push('javascript')

@endpush
