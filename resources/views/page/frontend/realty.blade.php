@extends('homepage.layout.home')
@section('content')

<div class="main-page">

    <div class="4xl:mt-[90px] mt-[35px]">
        <div class="container">
            <h1 class="font-extrabold 4xl:text-[40px] 3xl:text-[35px] 2xl:text-f40 lg:text-f30 text-f31 text-color_primary uppercase mt-[60px] mb-[50px] wow fadeInUp">{{$page->title}}</h1>
            @if($bds && $bds->isNotEmpty())
                @foreach($bds as $cat)
                    <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-[12px] mt-[20px]">
                        @foreach ($cat->posts as $post)
                            <div class="relative rounded-[30px] overflow-hidden wow fadeInUp" data-wow-delay="0.2s">
                                <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                    <img src="{{asset($post->image)}}" class="4xl:h-[265px] h-[255px] w-full object-cover object-bottom" alt="">
                                </div>
                                <ul class="absolute inline-flex left-[22px] z-10 top-[30px]">
                                    <li class="border py-[3px] px-[12px] 4xl:py-[8px] 4xl:text-f20 4xl:text-f16 3xl:text-f13 text-f12 text-white rounded-[100px]"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></li>
                                </ul>
                                <div class="absolute bottom-[30px] z-10 w-full text-white px-[24px]">
                                    <div class="text-f16 mb-2">{{ $post->created_at->format('M d, Y') }}</div>
                                    <h4 class="4xl:text-f24 3xl:text-f20 text-f19 font-semibold" style="
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
    </div>

    <div class="mt-[70px]">
        <div class="container">
            <div class="xl:flex gap-[30px]">
                <div class="xl:w-[1200px] w-full">
                    @if($news && $news->isNotEmpty())
                        @foreach($news as $cat)
                            <h3 class="font-bold 3xl:text-[40px] xl:text-f34 text-f31 uppercase">{{ $cat->title }}</h3>
                            <div class="grid md:grid-cols-2 grid-cols-1 gap-[12px] mt-[40px]">
                                @foreach ($cat->posts as $post)
                                <div class="relative rounded-[30px] overflow-hidden wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                        <img src="{{asset($post->image)}}" class="h-[300px] rounded-[20px] w-full object-cover object-bottom" alt="">
                                    </div>
                                    <ul class="absolute inline-flex left-[22px] z-10 top-[30px]">
                                        <li class="border py-[3px] px-[12px] 4xl:py-[8px] 4xl:text-f20 4xl:text-f16 3xl:text-f13 text-f12 text-white rounded-[100px]"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></li>
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
                <div class="flex-1 xl:mt-0 lg:mt-11 md:mt-[70px] mt-8">
                    @if($noibat && $noibat->isNotEmpty())
                        @foreach($noibat as $cat)
                        <h3 class="font-extrabold xl:text-[30px] lg:text-f40 text-f31 uppercase">{{ $cat->title }}</h3>
                        <div class="xl:mt-[50px] mt-[30px] h-[620px] overflow-y-scroll overflow-hidden scroll-bds">
                            @foreach ($cat->posts as $post)
                            <div class="md:flex gap-[25px] mb-[33px]">
                                <div class="md:w-[230px] flex-shrink-0">
                                    <img src="{{asset($post->image)}}" class="w-full h-[200px] object-cover rounded-[20px]" alt="">
                                </div>
                                <div class="flex-1  md:mt-0 mt-4">
                                    <div>
                                        <span class="text-color_primary">{{ $post->created_at->format('M d, Y') }}</span>
                                        <span class="ml-2"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></span>
                                    </div>
                                    <h4 class="3xl:text-f22 text-f20 font-bold mt-[22px]">
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
            </div>
            <div class="text-center mt-[30px]">
                <a href="" class="inline-block mt-[45px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary border-[3px] text-color_primary text-f25 px-[40px] py-[20px] rounded-[60px]">Xem thêm</a>
            </div>
        </div>
    </div>

    @if($kinhdoanh && $kinhdoanh->isNotEmpty())
        @foreach($kinhdoanh as $cat)
            <div class="mt-[85px]">
                <div class="container">
                    <h3 class="font-bold md:text-[40px] text-f31 text-center">{{ $cat->title }}</h3>
                    <div class="md:grid md:grid-cols-4  gap-[12px] mt-[35px]">
                        @foreach ($cat->posts as $k => $post)
                            <div class="@if( $k == 0 ) col-span-4 @else 3xl:col-span-1 md:col-span-2  @endif relative rounded-[30px] md:mb-0 mb-3 overflow-hidden wow fadeInUp" data-wow-delay="0.2s">
                                <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                    <img src="{{asset($post->image)}}" class="@if($k==0) md:h-[345px] @else md:h-[255px] @endif h-[255px] w-full object-cover object-bottom" alt="">
                                </div>
                                <ul class="absolute inline-flex left-[22px] z-10 top-[30px]">
                                    <li class="border py-[3px] px-[12px] 4xl:py-[8px] 4xl:text-f20 4xl:text-f16 3xl:text-f13 text-f12 text-white rounded-[100px]"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></li>
                                </ul>
                                <div class="absolute bottom-[30px] z-10 w-full text-white px-[24px]">
                                    <div class="text-f16 mb-2">{{ $post->created_at->format('M d, Y') }}</div>
                                    <h4 class="4xl:text-f24 3xl:text-f20 text-f19 font-semibold" style="
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
            </div>
        @endforeach
    @endif

    @if($cohoi && $cohoi->isNotEmpty())
        @foreach($cohoi as $cat)
            <div class="xl:mt-0 lg:mt-10 md:mt-[70px] mt-[50px] mb-[50px]">
                <div class="container">
                    <h3 class="font-bold md:text-[40px] text-f31 uppercase">{{ $cat->title }}</h3>
                    <div class="mt-[30px]">
                        <div class="lg:flex gap-[25px]">
                            <div class="xl:w-[745px] lg:w-1/2 w-full px-[33px] py-[40px] bg-color_primary text-white rounded-[20px]">
                                @foreach ($cat->posts as $k => $post)
                                    @if( $k < 4 )
                                    <div class="flex 3xl:pb-[40px] 3xl:mb-[45px] xl:pb-[35px] xl:mb-[35px] border-b border-b-[#fff]">
                                        <h3 class="flex-1 2xl:text-f24 text-f21 font-semibold ">
                                            <a href="{{route('routerURL', ['slug' => $post->slug])}}">
                                                {{$post->title}}
                                            </a>
                                        </h3>
                                        <div class="w-[80px]">
                                            <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="25.5" cy="25.5" r="24.5" fill="white" stroke="#C38E2B" stroke-width="2"/>
                                                <path d="M20.9232 13.0164L31.3848 25.2603L20.9232 37.5042" stroke="#C38E2B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="flex-1">
                                @foreach ($cat->posts as $k => $post)
                                    @if( $k==4 )
                                        <div class="relative rounded-[30px] lg:mt-0 mt-7 overflow-hidden wow fadeInUp" data-wow-delay="0.2s">
                                            <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                                <img src="{{asset($post->image)}}" class="4xl:h-[645px] lg:h-[610px] h-auto w-full object-cover object-bottom" alt="">
                                            </div>
                                            <ul class="absolute inline-flex left-[22px] z-10 top-[30px]">
                                                <li class="border py-[3px] px-[12px] 4xl:py-[8px] 4xl:text-f20 4xl:text-f16 3xl:text-f13 text-f12 text-white rounded-[100px]"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></li>
                                            </ul>
                                            <div class="absolute bottom-[30px] z-10 w-full text-white px-[24px]">
                                                <div class="text-f16 mb-2">{{ $post->created_at->format('M d, Y') }}</div>
                                                <h4 class="4xl:text-f24 3xl:text-f20 text-f19 font-semibold" style="
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
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-[30px]">
                        <a href="" class="inline-block mt-[45px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary border-[3px] text-color_primary text-f25 px-[40px] py-[20px] rounded-[60px]">Xem thêm</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

</div>

@endsection
