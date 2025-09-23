@extends('homepage.layout.home')
@section('content')
    <div class="main-page">
        
        @php
            $slide = getSlideHome($fcSystem['homepage_slide']);
            // dd($slide);
        @endphp
        {{-- Block 1 --}}
        @if( $slide && $slide->posts->isNotEmpty() )
            <section class="section-home lg:pb-[80px] md:pb-[60px] pb-[40px]">
                <div class="container">
                    <div class="swiper-for-one swiper-container wow fadeInUp">
                        <div class="swiper-wrapper">
                            @foreach( $slide->posts as $post )
                                @php
                                    $noibatID = json_decode($post->article_highlight, true);
                                    $noibat = getHighLightPost($noibatID);
                                    $thmer = getDataJson($post->postmetas, 'config_colums_json_slide_thmer');
                                    $comment = getDataJson($post->postmetas, 'config_colums_json_slides_top_slide');
                                @endphp
                                <div class="swiper-slide">
                                    <div>
                                        <img src="{{ asset($post->image) }}" class="w-full 3lx:h-[350px] 2xl:h-[240px] lg:h-[260px] object-cover rounded-[30px]" alt="">
                                    </div>
                    
                                    <div class="xl:flex gap-[30px] 3xl:mt-[55px] 2xl:mt-[30px] mt-[30px]">
                                        <div class="3xl:w-[895px] 2xl:w-[660px] xl:w-1/2 w-full">
                                            <h3 class="uppercase font-extrabold 3xl:text-f30 text-f24">Tin nổi bật</h3>
                                            <div class="md:flex gap-[12px] mt-[22px]">
                                                @foreach($noibat as $k => $item)
                                                    <div class="@if($k==0) 3xl:w-[528px] 2xl:w-[400px] xl:w-1/2 md:w-1/2 w-full @else flex-1 @endif md:mb-0 mb-3">
                                                        <div class="relative rounded-[30px] overflow-hidden">
                                                            <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                                                <img src="{{ asset($item->image) }}" class="3xl:h-[200px] 2xl:h-[145px] xl:h-[150px] lg:h-[250px] h-[170px] w-full object-cover object-bottom" alt="">
                                                            </div>
                                                            <ul class="absolute inline-flex left-[22px] z-10 top-[27px]">
                                                                <li class="border py-[3px] px-[12px] 3xl:text-f16 text-f12 text-white rounded-[100px]"><a href="{{ route('routerURL', ['slug' => $item->catalogues->slug]) }}">{{ $item->catalogues->title }}</a></li>
                                                                <li class="border py-[3px] px-[12px] 3xl:text-f16 text-f12 text-white rounded-[100px] ml-[12px]">{{ $item->created_at->format('M d, Y') }}</li>
                                                            </ul>
                                                            <div class="bg-color_primary 3xl:px-[22px] 3lx:py-[20px] p-[15px] relative z-10 w-full">
                                                                <h4 class="text-f20 text-white font-semibold" style="
                                                                overflow: hidden;
                                                                text-overflow: ellipsis;
                                                                -webkit-box-orient: vertical;
                                                                -webkit-line-clamp: 2;
                                                                display: -webkit-box;">
                                                                    <a href="{{ route('routerURL', ['slug' => $item->slug]) }}">
                                                                        {{ $item->title }}
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="flex-1 xl:mt-0 lg:mt-8 mt-9">
                                            <div class="md:flex xl:gap-[12px] lg:gap-[150px] w-full">
                                                <div class="3xl:w-[280px] 2xl:w-[205px] xl:w-[40%] lg:w-[250px] md:w-1/2 w-full">
                                                    @if(isset($thmer))
                                                    <h3 class="uppercase font-extrabold 3xl:text-f30 text-f24">THMer Sôi nổi</h3>
                                                    <div class="grid grid-cols-2 gap-3 mt-[22px] lg:w-full md:w-[65%]">
                                                        @foreach( $thmer->image as $k => $image )
                                                            <div>
                                                                <a href="{{ $thmer->url[$k] }}">
                                                                    <img src="{{ asset($image) }}" class="3xl:h-[130px] 2xl:h-[96px] xl:h-[110px] lg:h-[120px] md:h-[100px] h-[190px] @if($k == 0 || $k == 3) rounded-[20px] @else rounded-full @endif w-full object-cover object-center" alt="">
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="lg:flex-1 md:w-1/2 md:mt-0 mt-7">
                                                    <h3 class="uppercase font-extrabold 3xl:text-f30 text-f24">Top bình  luận</h3>
                                                    @if(isset($comment))
                                                        <div class="3xl:mt-[22px] lg:mt-5 mt-[14px]">
                                                            @foreach( $comment->image as $k => $image )
                                                                <div class="flex bg-[#EAEAE5] lg:gap-x-[25px] 3xl:mb-[22px] 2xl:mb-3 xl:mb-3 mb-4 3xl:py-[20px] 3xl:px-[18px] p-[15px] rounded-[30px]">
                                                                    <div class="3xl:w-[85px] 3xl:h-[85px] 2xl:w-[80px] 2xl:h-[80px] lg:h-[90px] md:h-[70px] md:w-[90px]">
                                                                        <img src="{{ asset($image) }}" class="w-full h-full rounded-full object-cover" alt="">
                                                                    </div>
                                                                    <div class="flex-1">
                                                                        <div class="comment-home">
                                                                            <h4 class="font-bold 3xl:text-f25 text-f18">
                                                                                <a href="{{ $comment->url[$k] }}" class="lg:whitespace-normal whitespace-nowrap" style="overflow: hidden;">{{ $comment->title[$k] }}</a>
                                                                            </h4>
                                                                            <div class="3xl:text-f16 text-f14 mt-2" style="
                                                                            overflow: hidden;
                                                                            text-overflow: ellipsis;
                                                                            -webkit-box-orient: vertical;
                                                                            -webkit-line-clamp: 2;
                                                                            display: -webkit-box;
                                                                        ">
                                                                                
                                                                            {{ $comment->desc[$k] }}
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </section>
        @endif

        {{-- Block 2 --}}
        @php
            $block2_info = getDataJson($page->fields, 'config_colums_json_home_thm_360_info');
            $block2_images = getDataJson($page->fields, 'config_colums_json_home_thm_360_images');
        @endphp
        <section class="xl:pt-[75px] md:pt-[35px]">
            <div class="container">
                @if( isset($block2_info) )
                    @foreach ($block2_info->image as $k => $image )
                        <div class="text-center wow fadeInUp">
                            <img src="{{ asset($image) }}" class="inline-block 3xl:h-[77px] xl:h-[53px] sm:h-[45px] h-[35px] w-auto object-contain" alt="">
                            <h3 class="font-misslegate 3xl:text-[96px] 3xl:h-[86px] 3xl:leading-[40px] xl:h-[60px] xl:leading-[31px] xl:text-[76px] 3xl:mt-[28px] xl:mt-[20px] sm:h-[50px] sm:leading-[30px] sm:mt-[15px] sm:text-[68px] text-[50px] h-[38px] leading-[21px] mt-3">{{ $block2_info->title[$k] }}</h3>
                            <div class="3xl:text-f30 xl:text-f22 font-bold 3xl:mt-[21px] xl:mt-[15px] mt-[15px] sm:text-[19px] text-f14 text-color_primary">{{ $block2_info->desc[$k] }}</div>
                        </div>
                    @endforeach
                @endif

                @if( isset($block2_images) )
                    {{-- PC --}}
                    <div class="xl:flex hidden items-center justify-center gap-[25px] mt-[35px]">
                        @foreach ($block2_images->image as $k => $image)
                            @if($k==0)
                                <div class="hover-img rounded-[30px] 3xl:w-[275px] 3xl:h-[337px] xl:w-[199px] xl:h-[238px] text-center relative after:content[''] after:bg-[linear-gradient(180deg,rgba(0,0,0,0)_0%,rgba(0,0,0,0.5)_84.47%)] after:absolute after:w-full after:h-full after:top-0 after:left-0 after:rounded-[30px] wow fadeInUp" data-wow-delay="0.6s">
                                    @include('homepage.home.item.item_block_2', [$block2_images, $k])
                                </div>
                            @endif
                            @if($k==1)
                            <div class="hover-img rounded-[30px] 3xl:w-[280px] 3xl:h-[390px] xl:w-[199px] xl:h-[277px] text-center relative after:content[''] after:bg-[linear-gradient(180deg,rgba(0,0,0,0)_0%,rgba(0,0,0,0.5)_84.47%)] after:absolute after:w-full after:h-full after:top-0 after:left-0 after:rounded-[30px] wow fadeInUp" data-wow-delay="0.3s">
                                @include('homepage.home.item.item_block_2', [$block2_images, $k])
                            </div>
                            @endif
                            @if($k==2)
                            <div class="hover-img rounded-[30px] 3xl:w-[280px] 3xl:h-[500px] xl:w-[199px] xl:h-[370px] text-center relative after:content[''] after:bg-[linear-gradient(180deg,rgba(0,0,0,0)_0%,rgba(0,0,0,0.5)_84.47%)] after:absolute after:w-full after:h-full after:top-0 after:left-0 after:rounded-[30px] wow fadeInUp" data-wow-delay="0.1s">
                                @include('homepage.home.item.item_block_2', [$block2_images, $k])
                            </div>
                            @endif
                            @if($k==3)
                            <div class="hover-img rounded-[30px] 3xl:w-[280px] 3xl:h-[390px] xl:w-[199px] xl:h-[277px] text-center relative after:content[''] after:bg-[linear-gradient(180deg,rgba(0,0,0,0)_0%,rgba(0,0,0,0.5)_84.47%)] after:absolute after:w-full after:h-full after:top-0 after:left-0 after:rounded-[30px] wow fadeInUp" data-wow-delay="0.3s">
                                @include('homepage.home.item.item_block_2', [$block2_images, $k])
                            </div>
                            @endif
                            @if($k==4)
                            <div class="hover-img rounded-[30px] 3xl:w-[275px] 3xl:h-[337px] xl:w-[199px] xl:h-[238px] text-center relative after:content[''] after:bg-[linear-gradient(180deg,rgba(0,0,0,0)_0%,rgba(0,0,0,0.5)_84.47%)] after:absolute after:w-full after:h-full after:top-0 after:left-0 after:rounded-[30px] wow fadeInUp" data-wow-delay="0.6s">
                                @include('homepage.home.item.item_block_2', [$block2_images, $k])
                            </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Tablet/Mobile --}}
                    <div class="xl:hidden block mt-[35px]">
                        <div class="swiper-block-2 swiper-container wow fadeInUp">
                            <div class="swiper-wrapper">
                                @foreach ($block2_images->image as $k => $image)
                                    <div class="swiper-slide">
                                        <div class="hover-img sm:h-[380px] h-[285px] text-center relative after:content[''] after:bg-[linear-gradient(180deg,rgba(0,0,0,0)_0%,rgba(0,0,0,0.5)_84.47%)] after:absolute after:w-full after:h-full after:top-0 after:left-0 after:rounded-[30px] wow fadeInUp" data-wow-delay="0.6s">
                                            @include('homepage.home.item.item_block_2', [$block2_images, $k])
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        {{-- Block 3 --}}
        @if(isset($isVanHoa) && count($isVanHoa) > 0)
            @foreach ($isVanHoa as $cat)
                @if( isset($cat->posts) )
                    <section class="2xl:mt-[156px] xl:mt-[80px] mt-[55px]">
                        <div class="container">
                            <div class="grid grid-cols-12 gap-[12px] xl:mt-[22px] mt-[35px]">
                                <div class="2xl:col-span-7 xl:col-span-7 xl:order-1 col-span-12 order-2">
                                    <div class="grid grid-cols-12 gap-[12px] xl:mt-[22px] md:mt-[60px] mt-[35px] md-hidden-5">
                                        @foreach($cat->posts as $k => $post)
                                            @if( $k == 0 )
                                                <div class="xl:col-span-8 lg:col-span-4 md:col-span-6 col-span-12 relative rounded-[30px] overflow-hidden wow fadeInUp" data-wow-delay="0.1s">
                                                    @include('homepage.home.item.item_block_3', ['post' => $post, 'k' => $k, 'cat_slug' => $cat->slug, 'cat_title' => $cat->title])
                                                </div>
                                            @elseif($k > 0 && $k < 5)
                                                <div class="xl:col-span-4 lg:col-span-4 md:col-span-6 col-span-12 relative rounded-[30px] overflow-hidden wow fadeInUp" data-wow-delay="{{ ($k+1)*0.1 }}s">
                                                    @include('homepage.home.item.item_block_3', ['post' => $post, 'k' => $k, 'cat_slug' => $cat->slug, 'cat_title' => $cat->title])
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="2xl:col-span-5  xl:col-span-5 xl:order-2 col-span-12 order-1 wow fadeInRight" data-wow-duration="1s">
                                    <div class="flex h-full items-center xl:justify-end justify-center">
                                        <div class="xl:w-[70%] md:text-center md:w-[475px] w-full">
                                            @if( !empty($cat->image) )
                                                <img src="{{ asset($cat->image) }}" class="3xl:h-[333px] 2xl:h-[245px] lg:h-[300px] h-[200px] inline-block object-contain object-bottom" alt="">
                                            @endif
                                            <div class="3xl:text-f25 3xl:mt-[85px] sm:mt-[35px] lg:text-justify sm:text-f22 text-16 mt-[20px] ">
                                                {!! $cat->description !!}
                                            </div>
                                            <div class="xl:text-left text-center">
                                                <a href="{{ route('routerURL', ['slug' => $cat->slug]) }}" class="inline-block lg:mt-[35px] sm:mt-[45px] mt-[20px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary lg:border-[3px] border text-color_primary 3xl:text-f25 sm:text-f22 text-f18 3xl:px-[40px] 3xl:py-[20px] 3xl:rounded-[60px] 2xl:rounded-[50px] 2xl:px-[30px] 2xl:py-[17px] px-[30px] py-[15px] rounded-[30px]">Xem thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endforeach
        @endif

        {{-- Block 4 --}}
        @php
            $block3_info = getDataJson($page->fields, 'config_colums_json_home_cout_project');
        @endphp
        @if( isset($block3_info) )
            @foreach( $block3_info->image as $k => $image )
                <section class="3xl:mt-[105px] 3xl:pt-[95px] 3xl:pb-[135px] 2xl:pt-[75px] 2xl:mt-[100px] lg:pt-[50px] lg:mt-[80px] lg:pb-[56px] sm:mt-[70px] sm:pt-[40px] sm:pb-[100px] pt-[100px] pb-[70px]" style="background: url('{{ asset($image) }}');background-repeat: no-repeat;background-repeat: no-repeat;background-size: contain;background-position: bottom;">
                    <div class="container">
                        <div class="text-center wow fadeInUp">
                            <h3 class="3xl:text-[64px] leading-[105%] lg:text-[50px] sm:text-[70px] sm:h-[50px] text-[52px] font-bold italic text-color_primary">{{ $block3_info->title[$k] }}</h3>
                            <h4 class="3xl:h-[78px] leading-[105%] 3xl:text-[96px] lg:text-[75px] lg:h-[60px] text-[78px] h-[65px] sm:text-[104px] sm:h-[115px] font-misslegate">{{ $block3_info->sub_title[$k] }}</h4>
                        </div>
                        <div class="flex justify-center 3xl:mt-[45px] 2xl:mt-[30px] mt-[20px] pt-[45px] wow fadeInUp">
                            <div class="3xl:w-[890px] lg:w-[800px] sm:w-[470px] w-full border-[3px] border-color_primary 3xl:px-[80px] 2xl:px-[70px] sm:px-[50px] px-[35px] py-[45px] rounded-[20px] bg-[rgba(255,251,242,0.68)]">
                                <div class="flex justify-center">
                                    <div class="flex justify-between">
                                        <div class="relative inline-block pr-[40px] after:content[''] after:h-[90%] after:w-[3px] after:bg-color_primary after:absolute after:right-0 after:top-1/2 after:translate-y-[-50%]">
                                            <span class="3xl:text-f30 lg:text-f22 sm:text-f17 text-13 font-bold">{{ $block3_info->name_pr[$k] }}</span>
                                            <span class="3xl:text-[90px] lg:text-[64px] sm:text-[47px] text-[35px] font-bold text-[#379E74] counter" data-target="{{ $block3_info->number_pr[$k] }}">{{ $block3_info->number_pr[$k] }}</span>
                                        </div>
                                        <div class="sm:pl-[40px] pl-[15px] inline-block text-center">
                                            <span class="3xl:text-f30 lg:text-f22 sm:text-f17 text-13 font-bold">{{ $block3_info->name_people[$k] }}</span>
                                            <span class="3xl:text-[90px] lg:text-[64px] sm:text-[47px] text-[35px] font-bold text-[#379E74] counter" data-target="{{ $block3_info->number_people[$k] }}">{{ $block3_info->number_people[$k] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="3xl:text-f30 lg:text-f24 font-bold mt-[35px] text-center">
                                    {{ $block3_info->tile_desc[$k] }}
                                </div>
                                <div class="3xl:text-f20 lg:text-f18 mt-[20px] text-[#2B2B2B] text-center">
                                    <div>{!! $block3_info->desc[$k] !!}</div>
                                    <a href="{{ $block3_info->url[$k] }}" class="inline-block lg:mt-[35px] sm:mt-[45px] mt-[20px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary lg:border-[3px] border text-color_primary 3xl:text-f25 sm:text-f22 text-f18 3xl:px-[40px] 3xl:py-[20px] 3xl:rounded-[60px] 2xl:rounded-[50px] 2xl:px-[30px] 2xl:py-[17px] px-[30px] py-[15px] rounded-[30px]">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        @endif

        {{-- Block 5 --}}
        @if( isset($homeMedia) && count($homeMedia->children) )
            <section class="mt-[110px]">
                <div class="container">
                    <div class="xl:flex 3xl:gap-[170px] 2xl:gap-[85px] xl:gap-[50px] mt-[22px] tabBlock">
                        <div class="flex-1 lg:flex 2xl:justify-left justify-center items-center wow fadeInLeft">
                            <div>
                                <h3 class="3xl:text-[131px] 2xl:text-[110px] xl:text-left xl:text-[75px] text-center sm:text-[54px] text-[36px] font-bold uppercase 3xl:leading-[105px] 2xl:leading-[100px] xl:leading-[70px]">{{ $homeMedia->title }}</h3>
                                <div class="2xl:mt-[35px] xl:mt-[40px] mt-[30px]">
                                    <ul class="tabBlock-tabs xl:text-left text-center">
                                        @foreach( $homeMedia->children as $k => $cat )
                                            <li class="inline-block"><a href="javascript:void(0)" data-tab="data-tab-{{ $k }}" class="tabBlock-tab border @if( $k ==0 ) border-color_primary bg-color_primary text-white @else border-black @endif rounded-[115px] text-f18 mr-[20px]  py-[3px] px-[14px] inline-block hover:border-color_primary duration-300">{{ $cat->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="" class="xl:inline-block hidden lg:mt-[55px] sm:mt-[45px] mt-[20px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary lg:border-[3px] border text-color_primary 3xl:text-f25 sm:text-f22 text-f18 3xl:px-[40px] 3xl:py-[20px] 3xl:rounded-[60px] 2xl:rounded-[50px] 2xl:px-[30px] 2xl:py-[17px] px-[30px] py-[15px] rounded-[30px]">Xem thêm</a>
                            </div>
                        </div>
                        <div class="3xl:w-[1200px] 2xl:w-[880px] xl:w-[700px] w-full wow fadeInRight">
                            <div class="tabBlock-content">
                                @foreach( $homeMedia->children as $k => $cat )
                                    <div class="tabBlock-pane" id="data-tab-{{$k}}" @if($k>0) style="display: none" @endif>
                                        <h3 class="3xl:text-f36 2xl:text-f32 xl:text-f30 sm:text-f24 xl:text-left text-center sm:mt-[30px] mt-[30px] font-bold text-color_primary">{{showField($cat->fields, 'config_colums_input_video_title_tab')}}</h3>
                                        <div class="grid grid-cols-12 gap-[12px] mt-[30px]">
                                            @if( isset($cat->listMedia) )
                                                @foreach( $cat->listMedia as $k => $post )
                                                    <div class="@if($k==0) xl:col-span-6 @else xl:col-span-3 @endif lg:col-span-4 sm:col-span-6 col-span-12 relative rounded-[30px] overflow-hidden">
                                                        <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                                            <img src="{{ asset(!empty($post->image) ? $post->image : 'images/404.jpg') }}" class="3xl:h-[640px] 2xl:[465px] lg:h-[500px] sm:h-[390px] h-[275px] w-full object-cover object-bottom" alt="">
                                                        </div>
                                                        <div class="absolute bottom-5 z-10 w-full text-white px-[22px]">
                                                            <h4 class="lg:text-f24 text-f20 font-bold lg:text-center text-left" style="
                                                                overflow: hidden;
                                                                text-overflow: ellipsis;
                                                                -webkit-box-orient: vertical;
                                                                -webkit-line-clamp: 2;
                                                                display: -webkit-box;
                                                            ">
                                                                {{$post->title}}
                                                            </h4>
                                                        </div>
                                                        <a href="{{$post->video_iframe}}" class="absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]">
                                                            <img src="/upload/images/logo/icon-play.png" alt="">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="lg:hidden text-center">
                            <a href="" class="inline-block lg:mt-[55px] sm:mt-[45px] mt-[20px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary lg:border-[3px] border text-color_primary 3xl:text-f25 sm:text-f22 text-f18 3xl:px-[40px] 3xl:py-[20px] 3xl:rounded-[60px] 2xl:rounded-[50px] 2xl:px-[30px] 2xl:py-[17px] px-[30px] py-[15px] rounded-[30px]">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        

        {{-- Block 6 --}}
        @if(isset($homeBDS) && count($homeBDS->children) > 0)
            <section class="mt-[85px]">
                <div class="container tabBlock">
                    <div class="xl:flex justify-between items-center lg:text-left text-center mb-[45px] wow fadeInUp">
                        <h3 class="font-bold 3xl:text-[64px] 2xl:text-[56px] sm:text-[54px] text-[36px] lg:mt-0 mt-[40px]">{{ $homeBDS->title }}</h3>
                        <ul class="tabBlock-tabs xl:mt-0 mt-[30px]">
                            @foreach( $homeBDS->children as $k => $cat )
                                <li class="inline-block"><a href="javascript:void(0)" data-tab="data-bds-{{ $k }}" class="tabBlock-tab sm:mb-0 mb-1 border @if( $k ==0 ) border-color_primary bg-color_primary text-white @else border-black @endif rounded-[115px] text-f18 sm:mr-[20px] mr-[10px] py-[3px] px-[14px] inline-block hover:border-color_primary duration-300">{{ $cat->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tabBlock-content md:mt-0 mt-[40px]">
                        @foreach( $homeBDS->children as $k => $cat )
                            <div class="tabBlock-pane" id="data-bds-{{$k}}" @if($k>0) style="display: none" @endif>
                                
                                <div class="grid grid-cols-12 gap-[10px]">
                                    @if( isset($cat->postsDBS) )
                                        @foreach( $cat->postsDBS as $k => $post )
                                            <div class="@if( $k==0 ) 2xl:col-span-6 @elseif($k>0 && $k<3) 2xl:col-span-3 @else 2xl:col-span-4  @endif lg:col-span-4 sm:col-span-6 col-span-12 relative rounded-[30px] overflow-hidden">
                                                <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                                    <img src="{{asset($post->image)}}" class="@if( $k<3 ) h-[360px]  @else h-[255px]  @endif w-full object-cover object-bottom" alt="">
                                                </div>
                                                <ul class="absolute inline-flex left-[22px] z-10 top-[27px]">
                                                    <li class="border py-[3px] px-[12px] text-f16 text-white rounded-[100px] hover:bg-white hover:text-color_primary duration-300"><a href="{{route('routerURL', ['slug' => $cat->slug])}}">{{$cat->title}}</a></li>
                                                </ul>
                                                <div class="absolute bottom-5 z-10 w-full text-white px-[22px]">
                                                    <div class="text-f16 mb-2">{{ formatDateVietnamese($post->created_at) }}</div>
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
                                    @endif
                                </div>

                                    
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="text-center mt-[30px] wow fadeInUp" data-wow-delay="0.8s">
                        <a href="" class="inline-block lg:mt-[55px] sm:mt-[45px] mt-[20px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary lg:border-[3px] border text-color_primary 3xl:text-f25 sm:text-f22 text-f18 3xl:px-[40px] 3xl:py-[20px] 3xl:rounded-[60px] 2xl:rounded-[50px] 2xl:px-[30px] 2xl:py-[17px] px-[30px] py-[15px] rounded-[30px]">Xem thêm</a>
                    </div>
                </div>
            </section>
        @endif
        
    </div>
@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            $('.tabBlock-tab').click(function() {
                var idTab = $(this).attr('data-tab'); // lấy id tab cần hiển thị

                // 1. Ẩn tất cả tab content
                $(this).parents('.tabBlock').find('.tabBlock-pane').hide();

                // 2. Hiện tab theo id click với hiệu ứng fade
                $('#' + idTab).fadeIn(600);

                console.log($('#' + idTab));
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var swiperHome = new Swiper(".section-home .swiper-container", {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 20,
                pagination: {
                    el: ".section-home .swiper-pagination",
                    clickable: true
                }
            });

            var swiperTwoCol = new Swiper(".swiper-for-col.swiper-container", {
                centeredSlides: true,
                loop: true,
                spaceBetween: 20,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true
                },
                slidesPerView: 1
            });
            
            if( $(window).width() < 1025 ){
                var swiperBlock2 = new Swiper(".swiper-block-2.swiper-container", {
                    loop: true,
                    speed: 1000, // tốc độ chuyển slide (ms)
                    spaceBetween: 20,
                    pagination: {
                        el: ".swiper-block-2 .swiper-pagination",
                        clickable: true
                    },
                    loop: true,
                    autoplay: {
                        delay:2000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 3
                        },
                        1024: {
                            slidesPerView: 4
                        },
                    }
                });
            }
        })
    </script>
@endpush
