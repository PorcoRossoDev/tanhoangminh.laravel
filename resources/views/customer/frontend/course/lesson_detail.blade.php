@extends('homepage.layout.home')
@section('content')
    <div class="main-page">
        <div class="container">
            <div class="content-page">

                <div class="bg-[#f5f5f5] flex items-center px-3 py-2.5 border-1 border-[#ddd]">
                    <img class="h-6 mr-1 w-6" src="http://ezdaily.laravel/frontend/images/book-alt.svg" alt="">
                    <span class="font-black text-f20">{{ $detail->title }}</span>
                </div>

                @if (isset($detail->videos) && count($detail->videos) > 0)
                    <div class="grid grid-cols-12 gap-6 mt-[20px]">
                        <div class="col-span-12">
                            <div id="video-container" class='embed-container'>
                                <iframe src='{{ $detail->videos->first()->link }}' frameborder='0' webkitAllowFullScreen
                                    mozallowfullscreen allowFullScreen></iframe>
                            </div>

                        </div>
                        <div class="col-span-12">
                            <div class="font-bold">課程清單:</div>
                            <div class="mt-4">
                                @foreach ($detail->videos as $key => $video)
                                    <ul class="pl-0">
                                        <li class="">
                                            <a href="javascript:void(0)" data-id="{{$video->id}}" class="@if($key==0) text-primary @endif btn-load-video border-b flex flex-wrap items-center justify-between pb-3">
                                                <div class="">
                                                    <h4 class="flex mb-0">
                                                        <img class="h-4 w-4" src="{{ asset('frontend/images/video-alt.svg') }}" alt="" style="">
                                                        <span class="font-medium ml-3 text-f17">
                                                        <b>Video:</b>
                                                            {{ $video->name }}
                                                        </span>
                                                    </h4>
                                                </div>
                                                <div class="text-blackColor dark:text-blackColor-dark text-sm flex items-center">
                                                    <div class="flex items-center">
                                                        <img class="h-4 w-4 mr-1" src="{{ asset('frontend/images/clock-time.svg') }}" alt="" style=""> {{ formatDuration($video->duration) }}
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('javascript')
<script>
    $('document').ready(function(){
        $('.btn-load-video').click(function() {
            $('.btn-load-video').removeClass('text-primary')
            $(this).addClass('text-primary')
            var id = $(this).attr('data-id')
            $.ajax({
                url: "<?php echo route('customer.lesson_video_item'); ?>",
                type: "GET",
                data: { id },
                success: function (res) {
                    if (res.embed_url) {
                        $("#video-container").html(`
                            <iframe src="${res.embed_url}" width="640" height="360"
                                frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
                            </iframe>
                        `);
                    } else {
                        alert("找不到视频");
                    }
                },
                error: function () {
                    alert("加载视频时出错");
                }
            });
            return false;
        })
    })
</script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}" />
    <style>
        .embed-container {
            --video--width: 1296;
            --video--height: 540;

            position: relative;
            padding-bottom: calc(var(--video--height) / var(--video--width) * 100%);
            /* 41.66666667% */
            overflow: hidden;
            max-width: 100%;
            background: black;
        }

        .embed-container iframe,
        .embed-container object,
        .embed-container embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endpush
