@extends('homepage.layout.home')
@section('content')

<div class="main-page">
    @section('banner')
        @include('homepage.common.banner', ['banner' => asset($page->image)])
    @endsection

    {{-- Block 1 --}}
    <section class="mt-[55px]">
        <div class="container">
            <div class="xl:flex xl:flex-row gap-[25px] wow fadeInLeft">
                <div class="2xl:flex-1 xl:w-full w-full mt-[40px]">
                    @if($noibat && $noibat->isNotEmpty())
                        @foreach($noibat as $cat)
                            <div>
                                <span class="md:text-f30 text-f26 font-extrabold block">{{ $cat->title }}</span>
                                <div class="4xl:mt-[50px] 3xl:mt-[30px] mt-[30px] h-[485px] overflow-y-scroll overflow-hidden scroll-bds">
                                    @foreach ($cat->posts as $post)
                                        <div class="border-b border-b-[#D8D8D8] mb-[25px]">
                                            <ul class="flex text-f14">
                                                <li class="text-white bg-color_primary py-[3px] px-[14px] rounded-[20px]"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></li>
                                                <li class="text-color_primary ml-[20px]">{{ $post->created_at->format('M d, Y') }}s</li>
                                            </ul>
                                            <h3 class="color-[#811317] font-semibold md:text-f20 text-f18 mt-[20px] pb-[36px]">
                                                <a href="{{route('routerURL', ['slug' => $post->slug])}}">
                                                    {{$post->title}}
                                                </a>
                                            </h3>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="4xl:w-[890px] 3xl:w-[700px] 2xl:w-[640px] xl:mt-0 mt-5 w-full wow fadeInTop">
                    <h1 class="font-extrabold 4xl:text-[60px] 3xl:text-[45px] md:text-[50px] text-f40 text-color_primary text-center">THM 360</h1>
                    <div class="mt-[35px] relative rounded-[30px] overflow-hidden wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                            <img src="/upload/images/logo/banner-360.jpg" class="h-[485px] w-full object-cover object-bottom" alt="">
                        </div>
                        <div class="absolute bottom-5 z-10 w-full text-white px-[22px]">
                            <div class="inline-block border border-white text-f16 rounded-[100px] text-white py-[4px] px-[12px]">
                                THM 360
                            </div>
                            <div class="text-f16 mb-2 mt-[20px]">March 20, 2025</div>
                            <h4 class="text-f24 font-semibold" style="
                                overflow: hidden;
                                text-overflow: ellipsis;
                                -webkit-box-orient: vertical;
                                -webkit-line-clamp: 2;
                                display: -webkit-box;
                            ">
                                Tips for First-Time Homebuyers: 
                                A Comprehensive Guide
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="2xl:flex-1 w-full mt-[40px]  wow fadeInRight">
                    <div>
                        <span class="text-f30 font-extrabold block">Top bình luận</span>
                        <div class="4xl:mt-[50px] 3xl:mt-[30px] ">
                            @if( $comment && $comment->slides->isNotEmpty() )
                                @foreach( $comment->slides as $slide )
                                    <div class="flex bg-[#EAEAE5] mt-[22px] py-[24px] px-[15px] rounded-[30px] th360-comment">
                                        <img src="{{ asset($slide->src) }}" class="w-[85px] h-[85px] rounded-full object-cover" alt="">
                                        <div class="ml-[25px]">
                                            <h4 class="font-semibold 4xl:text-f25 3xl:text-f21 text-f20" style="
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            -webkit-box-orient: vertical;
                                            -webkit-line-clamp: 1;
                                            display: -webkit-box;
                                        "><a href="{{ $slide->link }}">{{ $slide->title }}</a></h4>
                                            <div class="4xl:text-f16 text-f15 mt-2" style="
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            -webkit-box-orient: vertical;
                                            -webkit-line-clamp: 3;
                                            display: -webkit-box;
                                        ">
                                                {{ $slide->description }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Block Zoom && THMer --}}
    <section class="mt-[65px]">
        <div class="container">
            <div class="xl:flex gap-[30px]">
                <div class="4xl:w-[1200px] 3xl:w-[900px] xl:w-[600px] w-full">
                    @if($th_zoom && $th_zoom->isNotEmpty())
                        @foreach($th_zoom as $cat)
                            <h3 class="font-bold 4xl:text-[40px] 3xl:text-f34 xl:text-[30px] text-f26 uppercase">{{ $cat->title }}</h3>
                            <div class="grid md:grid-cols-2 grid-cols-1 gap-[12px] mt-[40px]">
                                @foreach ($cat->posts as $post)
                                <div class="relative rounded-[30px] overflow-hidden wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                        <img src="{{asset($post->image)}}" class="h-[300px] rounded-[20px] w-full object-cover object-bottom" alt="">
                                    </div>
                                    <ul class="absolute inline-flex left-[22px] z-10 top-[30px]">
                                        <li class="border py-[3px] px-[12px] text-f16 text-white rounded-[100px] hover:bg-white hover:text-color_primary duration-300"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></li>
                                    </ul>
                                    <div class="absolute bottom-[30px] z-10 w-full text-white px-[24px]">
                                        <div class="text-f16 mb-2">{{ $post->created_at->format('M d, Y') }}</div>
                                        <h4 class="xl:text-f20 text-f19 font-semibold" style="
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            -webkit-box-orient: vertical;
                                            -webkit-line-clamp: 2;
                                            display: -webkit-box;
                                        ">
                                            <a href="{{route('routerURL', ['slug' => $post->slug])}}">
                                                {{$post->title}}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="xl:flex-1 w-full mt-[25px]">
                    <h3 class="font-extrabold 3xl:text-f30 xl:text-f40 text-f26">THMer Sôi nổi</h3>
                    @if( $thmer && $thmer->slides->isNotEmpty() )
                        <div class="mt-[40px] h-[620px] overflow-y-scroll scroll-bds">
                            @foreach( $thmer->slides as $k => $slide )
                            <div class="flex gap-[25px] items-center mb-[32px]">
                                <div class="w-[128px] h-[128px]">
                                    <a href="{{ $slide->link }}">
                                        <img src="{{ asset($slide->src) }}" class="w-full @if($k%2==0) rounded-[20px]  @else rounded-full @endif object-cover h-full" alt="">
                                    </a>
                                </div>
                                <div class="flex-1">
                                    <h3 class="2xl:text-f22 text-f22 font-semibold"><a href="{{ $slide->link }}">{{ $slide->title }}</a></h3>
                                    <div class="2xl:text-f20 md:text-f21 text-f18 text-color_primary">{{ $slide->description }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center md:mt-[40px] mt-5">
                <a href="" class="inline-block hover:bg-color_primary hover:text-white duration-300 font-semibold border-color_primary border-[2px] text-color_primary md:text-f19 text-f18 xl:px-[40px] px-[15px] md:py-[10px] py-[5px] rounded-[60px]">Xem thêm</a>
            </div>
        </div>
    </section>

    @if(isset($th_sport) && $th_sport->isNotEmpty())
        @foreach($th_sport as $cat)
            <section class="lg:mt-[85px] mt-[40px]">
                <div class="container">
                    <h3 class="font-bold 3xl:text-[40px] xl:text-f40 text-f26">{{ $cat->title }}</h3>
                    <div class="xl:flex mt-[40px] md:gap-[30px] gap-[20px]">
                        <div class="4xl:w-[615px] 3xl:w-[500px] w-full 4xl:h-[630px] 3xl:h-[425px] xl:w-[500px] xl:h-[500px] overflow-y-scroll scroll-bds flex-shrink-0">
                            @foreach( $cat->posts as $k => $post )
                            <div class="flex gap-[30px] mb-[33px]">
                                <div class="4xl:w-[245px] 3xl:w-[185px] 4xl:h-[200px] 3xl:h-[180px] xl:w-[200px] lg:w-[300px] xl:h-[200px] md:w-[250px] md:h-[250px] w-[160px] h-[160px]">
                                    <img src="{{asset($post->image)}}" class="w-full h-full object-cover rounded-[20px]" alt="">
                                </div>
                                <div class="flex-1">
                                    <div>
                                        <span class="text-color_primary">{{ $post->created_at->format('M d, Y') }}</span>
                                        <span class="ml-[15px]"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></span>
                                    </div>
                                    <div class="mt-[22px]">
                                        <h3 class="font-semibold 4xl:text-f22 3xl:text-f21 xl:text-f21 text-f18 leading-normal"><a href="{{route('routerURL', ['slug' => $post->slug])}}">{{$post->title}}</a></h3>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="xl:flex-1 w-full xl:mt-0 md:mt-6 mt-[40px] tabBlock min-w-0">
                            <ul class="tabBlock-tabs xl:text-left text-center 2xl:text-f18 xl:text-f16">
                                <li class="inline-block"><a href="javascript:void(0)" data-tab="data-file-1" class="tabBlock-tab border border-color_primary bg-color_primary text-white rounded-[10px] 2xl:mr-[20px] mr-[15px] 2xl:py-[8px] py-[3px] px-[14px] inline-block hover:bg-color_primary hover:text-white hover:border-color_primary duration-300">Tài liệu mới</a></li>
                                <li class="inline-block"><a href="javascript:void(0)" data-tab="data-file-2" class="tabBlock-tab border rounded-[10px] 2xl:mr-[20px] mr-[15px] 2xl:py-[8px] bg-[#e3e1e1] py-[3px] px-[14px] inline-block hover:bg-color_primary hover:text-white hover:border-color_primary duration-300">Tài liệu xem nhiều</a></li>
                            </ul>
                            <div class="tabBlock-content mt-[30px]">
                                <div class="tabBlock-pane relative" id="data-tab-1">
                                    <div class="overflow-hidden">
                                        <div class="swiper-block-media swiper-container overflow-hidden">
                                            <div class="swiper-wrapper">
                                                @if(isset($file1) && $file1->slides->isNotEmpty())
                                                    @foreach ($file1->slides as $slide)
                                                        <div class="swiper-slide">
                                                              <img src="{{ asset($slide->src) }}" class="w-full" alt="">  
                                                              <h3 class="font-semibold mt-4">{{ $slide->title }}</h3>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-prev-media swiper-ctm absolute top-1/2 translate-y-[-50%] 4xl:left-[-85px] xl:left-[-85px] z-10">
                                        <img src="{{ asset('frontend/images/button-left.png') }}" class="4xl:w-auto 3xl:h-[35px]" alt="">
                                    </div>
                                    <div class="swiper-next-media swiper-ctm absolute top-1/2 translate-y-[-50%] 4xl:right-[-85px] xl:right-[-85px] z-10">
                                        <img src="{{ asset('frontend/images/button-right.png') }}" class="4xl:w-auto 3xl:h-[35px]" alt="">
                                    </div>
                                </div>
                                <div class="tabBlock-pane relative" id="data-tab-2" style="display: none">
                                    <div class="overflow-hidden">
                                        <div class="swiper-block-media swiper-container overflow-hidden">
                                            <div class="swiper-wrapper">
                                                @if(isset($file2) && $file2->slides->isNotEmpty())
                                                    @foreach ($file2->slides as $slide)
                                                        <div class="swiper-slide">
                                                              <img src="{{ asset($slide->src) }}" class="w-full" alt="">  
                                                              <h3>{{ $slide->title }}</h3>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-prev-media swiper-ctm absolute top-1/2 translate-y-[-50%] 4xl:left-[-85px] xl:left-[-85px] z-10">
                                        <img src="{{ asset('frontend/images/button-left.png') }}" class="4xl:w-auto 3xl:h-[35px]" alt="">
                                    </div>
                                    <div class="swiper-next-media swiper-ctm absolute top-1/2 translate-y-[-50%] 4xl:right-[-85px] xl:right-[-85px] z-10">
                                        <img src="{{ asset('frontend/images/button-right.png') }}" class="4xl:w-auto 3xl:h-[35px]" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-[30px] wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                        <a href="" class="inline-block hover:bg-color_primary hover:text-white duration-300 font-semibold border-color_primary border-[2px] text-color_primary md:text-f19 text-f18 xl:px-[40px] px-[15px] md:py-[10px] py-[5px] rounded-[60px]">Xem thêm</a>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
        

    {{-- Block 4 --}}
    @if(isset($th_leauge) && $th_leauge->isNotEmpty())
        @foreach($th_leauge as $cat)
            <section class="mt-[85px]">
                <div class="container">
                    <div class="flex justify-between items-center md:mb-[45px] mb-[20px] wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <h3 class="font-bold md:text-[40px] text-f26">{{ $cat->title }}</h3>
                    </div>
                    <div class="grid grid-cols-12 gap-[10px]">
                        @foreach( $cat->posts as $k => $post )
                            <div class="@if( $k==0 ) 2xl:col-span-6 @elseif($k>0 && $k<3) 2xl:col-span-3 @else 2xl:col-span-4  @endif lg:col-span-4 sm:col-span-6 col-span-12 relative rounded-[30px] overflow-hidden">
                                <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                    <img src="{{asset($post->image)}}" class="@if( $k<3 ) 2xl:h-[360px]  @else 2xl:h-[255px]  @endif xl:h-[285px] h-[255px] w-full object-cover object-bottom" alt="">
                                </div>
                                <ul class="absolute inline-flex left-[22px] z-10 top-[27px]">
                                    <li class="border py-[3px] px-[12px] text-f16 text-white rounded-[100px] hover:bg-white hover:text-color_primary duration-300"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></li>
                                </ul>
                                <div class="absolute bottom-5 z-10 w-full text-white px-[22px]">
                                    <div class="text-f16 mb-2">{{ $post->created_at->format('M d, Y') }}</div>
                                    <h4 class="xl:text-f21 font-semibold" style="
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        -webkit-box-orient: vertical;
                                        -webkit-line-clamp: 2;
                                        display: -webkit-box;
                                    ">
                                        {{$post->title}}
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-[40px] wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                        <a href="" class="inline-block hover:bg-color_primary hover:text-white duration-300 font-semibold border-color_primary border-[2px] text-color_primary md:text-f19 text-f18 xl:px-[40px] px-[15px] md:py-[10px] py-[5px] rounded-[60px]">Xem thêm</a>
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    @if($th_sport && $th_sport->isNotEmpty())
        @foreach($th_sport as $cat)
            <section class="mt-[40px]">
                <div class="container">
                    <h3 class="font-bold md:text-[40px] text-f26">{{ $cat->title }}</h3>
                    <div class="xl:flex mt-[40px] gap-[30px]">
                        <div class="4xl:w-[590px] 3xl:w-[470px] w-full h-[630px] overflow-y-scroll scroll-bds">
                            @foreach( $cat->posts as $k => $post )
                            <div class="flex gap-[30px] sm:h-[200px] h-[160px] mb-[33px]">
                                <div class="4xl:w-[245px] 3xl:w-[200px] md:w-[215px] w-[160px]">
                                    <img src="{{asset($post->image)}}" class="w-full h-full object-cover rounded-[20px]" alt="">
                                </div>
                                <div class="flex-1">
                                    <div>
                                        <span class="text-color_primary">{{ $post->created_at->format('M d, Y') }}</span>
                                        <span class="ml-[15px]"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></span>
                                    </div>
                                    <div class="mt-[22px]">
                                        <h3 class="font-semibold 4xl:text-f22 leading-normal text-f18"><a href="{{route('routerURL', ['slug' => $post->slug])}}">{{$post->title}}</a></h3>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="xl:flex-1 w-full xl:mt-0 mt-6">
                            @foreach( $cat->posts as $k => $post )
                                @if($k == 0)
                                    <div class="relative rounded-[30px] overflow-hidden wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                        <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                            <img src="{{asset($post->image)}}" class="3xl:h-[630px] xl:h-[400px] h-[300px] w-full object-cover object-bottom" alt="">
                                        </div>
                                        <div class="absolute bottom-5 z-10 w-full text-white px-[22px]">
                                            <div class="inline-block border border-white text-f16 rounded-[100px] text-white py-[4px] px-[12px]">
                                                <a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a>
                                            </div>
                                            <div class="text-f16 mb-2 mt-[20px]">{{ $post->created_at->format('M d, Y') }}</div>
                                            <h4 class="2xl:text-f24 text-f20 font-semibold" style="
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                                -webkit-box-orient: vertical;
                                                -webkit-line-clamp: 2;
                                                display: -webkit-box;
                                            ">
                                                <a href="{{route('routerURL', ['slug' => $post->slug])}}">{{$post->title}}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center mt-[30px] wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                        <a href="" class="inline-block hover:bg-color_primary hover:text-white duration-300 font-semibold border-color_primary border-[2px] text-color_primary md:text-f19 text-f18 xl:px-[40px] px-[15px] md:py-[10px] py-[5px] rounded-[60px]">Xem thêm</a>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
    
</div>

@endsection

@push('javascript')
    <script>
        $(document).ready(function() {
            var swipers = [];
            $('.swiper-block-media').each(function(index, element) {
                var swiper = new Swiper(element, {
                    loop: true,
                    slidesPerView: 1,
                    spaceBetween: 20,
                    breakpoints: {
                        320: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 3
                        },
                        1024: {
                            slidesPerView: 3
                        },
                        1366: {
                            slidesPerView: 2
                        },
                        1440: {
                            slidesPerView: 4
                        },
                    },
                    navigation: {
                        nextEl: $(element).parents('.tabBlock-pane').find('.swiper-next-media')[0],
                        prevEl: $(element).parents('.tabBlock-pane').find('.swiper-prev-media')[0],
                    },
                });
                swipers.push(swiper);
            });

            $('.tabBlock-tab').click(function() {
                var idTab = $(this).attr('data-tab'); // lấy id tab cần hiển thị

                // 1. Ẩn tất cả tab content
                $(this).parents('.tabBlock').find('.tabBlock-pane').hide();

                // 2. Hiện tab theo id click với hiệu ứng fade
                $('#' + idTab).fadeIn(600, function() {
                    // tìm Swiper trong tab này và update
                    var swiperInstance = $(this).find('.swiper-block-media')[0].swiper;
                    if (swiperInstance) {
                        swiperInstance.update();
                        swiperInstance.slideTo(0);
                    }
                });

                $(this).parents('.tabBlock-tabs').find('a').removeClass('bg-color_primary text-white border-color_primary').addClass('border-black text-black')
                $(this).addClass('bg-color_primary text-white border-color_primary');
            });

        });
    </script>
@endpush
