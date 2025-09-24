@extends('homepage.layout.home')
@section('content')

<div class="main-page">
    

    {{-- Block 1 --}}
    <section class="mt-[55px]">
        <div class="container">
            <div class="xl:flex xl:flex-row gap-[25px] wow fadeInLeft">
                <div class="2xl:flex-1 xl:w-full w-full mt-[40px]">
                    @if($noibat && $noibat->isNotEmpty())
                        @foreach($noibat as $cat)
                            <div>
                                <span class="text-f30 font-extrabold block">{{ $cat->title }}</span>
                                <div class="mt-[50px] h-[485px] overflow-y-scroll overflow-hidden scroll-bds">
                                    @foreach ($cat->posts as $post)
                                        <div class="border-b border-b-[#D8D8D8] mb-[25px]">
                                            <ul class="flex text-f14">
                                                <li class="text-white bg-color_primary py-[3px] px-[14px] rounded-[20px]"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></li>
                                                <li class="text-color_primary ml-[20px]">{{ $post->created_at->format('M d, Y') }}s</li>
                                            </ul>
                                            <h3 class="color-[#811317] font-bold text-f20 mt-[20px] pb-[36px]">
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
                <div class="3xl:w-[890px] 2xl:w-[640px] xl:mt-0 mt-5 w-full wow fadeInTop">
                    <h1 class="font-extrabold 2xl:text-[60px] text-[50px] text-f40px text-color_primary text-center">THM 360</h1>
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
                        <div class="mt-[50px]">
                            @if( $comment && $comment->slides->isNotEmpty() )
                                @foreach( $comment->slides as $slide )
                                    <div class="flex bg-[#EAEAE5] mt-[22px] py-[24px] px-[15px] rounded-[30px] th360-comment">
                                        <img src="{{ asset($slide->src) }}" class="w-[85px] h-[85px] rounded-full object-cover" alt="">
                                        <div class="ml-[25px]">
                                            <h4 class="font-bold 2xl:text-f25 md:text-f21 text-f20" style="
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            -webkit-box-orient: vertical;
                                            -webkit-line-clamp: 1;
                                            display: -webkit-box;
                                        "><a href="{{ $slide->link }}">{{ $slide->title }}</a></h4>
                                            <div class="text-f16 mt-2" style="
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
                <div class="2xl:w-[1200px] xl:w-[800px] w-full">
                    @if($th_zoom && $th_zoom->isNotEmpty())
                        @foreach($th_zoom as $cat)
                            <h3 class="font-bold text-[40px] uppercase">{{ $cat->title }}</h3>
                            <div class="grid grid-cols-2 gap-[12px] mt-[40px]">
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
                                        <h4 class="text-f24 font-semibold" style="
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
                    <h3 class="font-extrabold text-f30">THMer Sôi nổi</h3>
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
                                    <h3 class="2xl:text-f26 text-f22 font-bold"><a href="{{ $slide->link }}">{{ $slide->title }}</a></h3>
                                    <div class="2xl:text-f22 text-f21 text-color_primary">{{ $slide->description }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center">
                <a href="" class="inline-block mt-[45px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary border-[3px] text-color_primary text-f25 px-[40px] py-[20px] rounded-[60px]">Xem thêm</a>
            </div>
        </div>
    </section>
        

    {{-- Block 3 --}}
    @if($th_edu && $th_edu->isNotEmpty())
        @foreach($th_edu as $cat)
            <section class="mt-[85px]">
                <div class="container">
                    <h3 class="font-bold text-[40px] text-center">{{ $cat->title }}</h3>
                    <div class="grid grid-cols-4 gap-[12px] mt-[35px]">
                        @foreach ($cat->posts as $k => $post)
                            <div class="@if( $k == 0 ) lg:col-span-4 md:col-span-4 @else  @endif relative rounded-[30px] overflow-hidden wow fadeInUp" data-wow-delay="0.2s">
                                <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                    <img src="{{asset($post->image)}}" class="@if($k==0) h-[345px] @else h-[255px] @endif  w-full object-cover object-bottom" alt="">
                                </div>
                                <ul class="absolute inline-flex left-[22px] z-10 top-[30px]">
                                    <li class="border py-[3px] px-[12px] text-f16 text-white rounded-[100px] hover:bg-white hover:text-color_primary duration-300"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></li>
                                </ul>
                                <div class="absolute bottom-[30px] z-10 w-full text-white px-[24px]">
                                    <div class="text-f16 mb-2">{{ $post->created_at->format('M d, Y') }}</div>
                                    <h4 class="text-f24 font-semibold" style="
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
                    <div class="text-center mt-[30px]">
                        <a href="" class="inline-block mt-[45px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary border-[3px] text-color_primary text-f25 px-[40px] py-[20px] rounded-[60px]">Xem thêm</a>
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    {{-- Block 4 --}}
    @if($th_edu && $th_edu->isNotEmpty())
        @foreach($th_edu as $cat)
            <section class="mt-[85px]">
                <div class="container">
                    <div class="flex justify-between items-center mb-[45px] wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <h3 class="font-bold text-[40px]">{{ $cat->title }}</h3>
                    </div>
                    <div class="grid grid-cols-12 gap-[10px]">
                        @foreach( $cat->posts as $k => $post )
                            <div class="@if( $k==0 ) 2xl:col-span-6 @elseif($k>0 && $k<3) 2xl:col-span-3 @else 2xl:col-span-4  @endif lg:col-span-4 sm:col-span-6 col-span-12 relative rounded-[30px] overflow-hidden">
                                <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                    <img src="{{asset($post->image)}}" class="@if( $k<3 ) lg:h-[360px]  @else lg:h-[255px]  @endif h-[255px] w-full object-cover object-bottom" alt="">
                                </div>
                                <ul class="absolute inline-flex left-[22px] z-10 top-[27px]">
                                    <li class="border py-[3px] px-[12px] text-f16 text-white rounded-[100px] hover:bg-white hover:text-color_primary duration-300"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></li>
                                </ul>
                                <div class="absolute bottom-5 z-10 w-full text-white px-[22px]">
                                    <div class="text-f16 mb-2">{{ $post->created_at->format('M d, Y') }}</div>
                                    <h4 class="text-f24 font-semibold" style="
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
                    <div class="text-center mt-[30px] wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                        <a href="" class="inline-block mt-[45px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary border-[3px] text-color_primary text-f25 px-[40px] py-[20px] rounded-[60px]">Xem thêm</a>
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    @if($th_sport && $th_sport->isNotEmpty())
        @foreach($th_sport as $cat)
            <section class="mt-[85px]">
                <div class="container">
                    <h3 class="font-bold text-[40px]">{{ $cat->title }}</h3>
                    <div class="xl:flex mt-[40px] gap-[30px]">
                        <div class="xl:w-[590px] w-full h-[630px] overflow-y-scroll scroll-bds">
                            @foreach( $cat->posts as $k => $post )
                            <div class="flex gap-[30px] h-[200px] mb-[33px]">
                                <div class="w-[245px]">
                                    <img src="{{asset($post->image)}}" class="w-full h-full object-cover rounded-[20px]" alt="">
                                </div>
                                <div class="flex-1">
                                    <div>
                                        <span class="text-color_primary">{{ $post->created_at->format('M d, Y') }}</span>
                                        <span class="ml-[15px]"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></span>
                                    </div>
                                    <div class="mt-[22px]">
                                        <h3 class="font-bold text-f22"><a href="{{route('routerURL', ['slug' => $post->slug])}}">{{$post->title}}</a></h3>
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
                                            <img src="{{asset($post->image)}}" class="h-[630px] w-full object-cover object-bottom" alt="">
                                        </div>
                                        <div class="absolute bottom-5 z-10 w-full text-white px-[22px]">
                                            <div class="inline-block border border-white text-f16 rounded-[100px] text-white py-[4px] px-[12px]">
                                                <a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a>
                                            </div>
                                            <div class="text-f16 mb-2 mt-[20px]">{{ $post->created_at->format('M d, Y') }}</div>
                                            <h4 class="text-f24 font-semibold" style="
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
                        <a href="" class="inline-block mt-[45px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary border-[3px] text-color_primary text-f25 px-[40px] py-[20px] rounded-[60px]">Xem thêm</a>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
    
</div>

@endsection
