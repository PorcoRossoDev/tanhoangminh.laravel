@extends('homepage.layout.home')
@section('content')
    <div class="main-page">
        @section('banner')
            @include('homepage.common.banner', ['banner' => asset($page->image)])
        @endsection
        @php
            $slide = getSlideHome($fcSystem['homepage_slide']);
        @endphp
        {{-- Block Slide --}}
        @if( isset($slide) && $slide->posts->isNotEmpty() )
            <section class="section-home">
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
                                    <div class="hidden">
                                        <img src="{{ asset($post->image) }}" class="w-full 3lx:h-[350px] 2xl:h-[240px] lg:h-[260px] object-cover rounded-[30px]" alt="">
                                    </div>
                    
                                    <div class="xl:flex gap-[30px] 3xl:mt-[55px] 2xl:mt-[30px] mt-[30px]">
                                        <div class="4xl:w-[895px] 3xl:w-[610px] 2xl:w-[660px] xl:w-1/2 w-full">
                                            <h3 class="uppercase font-extrabold 4xl:text-f33 3xl:text-f27 text-f24">Tin nổi bật</h3>
                                            <div class="md:flex gap-[12px] mt-[22px]">
                                                @foreach($noibat as $k => $item)
                                                    <div class="@if($k==0) 4xl:w-[528px] 3xl:w-[345px] 2xl:w-[400px] xl:w-1/2 md:w-1/2 w-full @else flex-1 @endif md:mb-0 mb-3">
                                                        <div class="relative rounded-[30px] overflow-hidden">
                                                            <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                                                <img src="{{ asset($item->image) }}" class="4xl:h-[200px] 3xl:h-[190px] 2xl:h-[145px] xl:h-[150px] lg:h-[250px] h-[170px] w-full object-cover object-bottom" alt="">
                                                            </div>
                                                            <ul class="absolute inline-flex left-[22px] z-10 top-[27px]">
                                                                <li class="border py-[3px] px-[12px] 4xl:py-[8px] 4xl:text-f20 4xl:text-f16 3xl:text-f13 text-f12 text-white rounded-[100px]"><a href="{{ route('routerURL', ['slug' => $item->catalogues->slug]) }}">{{ $item->catalogues->title }}</a></li>
                                                                <li class="border py-[3px] px-[12px] 4xl:py-[8px] 4xl:text-f20 4xl:text-f16 3xl:text-f13 text-f12 text-white rounded-[100px] ml-[12px]">{{ $item->created_at->format('M d, Y') }}</li>
                                                            </ul>
                                                            <div class="bg-color_primary 3xl:px-[22px] 3lx:py-[20px] xl:px-[15px] xl:py-[15px] p-[15px] relative z-10 w-full">
                                                                <h4 class="4xl:text-f24 3xl:text-f19 xl:text-f18 text-f text-white font-semibold" style="
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
                                                    <h3 class="uppercase font-extrabold 4xl:text-f33 3xl:text-f27 text-f24">THMer Sôi nổi</h3>
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
                                                    <h3 class="uppercase font-extrabold 4xl:text-f33 3xl:text-f27 text-f24">Top bình  luận</h3>
                                                    @if(isset($comment))
                                                        <div class="3xl:mt-[22px] lg:mt-5 mt-[14px]">
                                                            @foreach( $comment->image as $k => $image )
                                                                <div class="flex bg-[#EAEAE5] lg:gap-x-[25px] 3xl:mb-[22px] 2xl:mb-3 xl:mb-3 mb-4 3xl:py-[20px] 3xl:px-[18px] p-[15px] rounded-[30px]">
                                                                    <div class="3xl:w-[85px] 3xl:h-[85px] xl:w-[80px] xl:h-[80px] lg:h-[90px] md:h-[70px] md:w-[90px] flex-shrink-0">
                                                                        <img src="{{ asset($image) }}" class="w-full h-full rounded-full object-cover" alt="">
                                                                    </div>
                                                                    <div class="flex-1 min-w-0">
                                                                        <div class="comment-home">
                                                                            <h4 class="font-bold 4xl:text-f27 3xl:text-f21 text-f18 overflow-hidden text-ellipsis whitespace-nowrap">
                                                                                <a href="{{ $comment->url[$k] }}" class=" whitespace-nowrap" style="overflow: hidden;">{{ $comment->title[$k] }}</a>
                                                                            </h4>
                                                                            <div class="4xl:text-f22 3xl:text-f15 text-f14 mt-2" style="
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

        {{-- Block TH360 --}}
        @php
            $block2_info = getDataJson($page->fields, 'config_colums_json_home_thm_360_info');
            $block2_images = getDataJson($page->fields, 'config_colums_json_home_thm_360_images');
        @endphp
        <section class="xl:pt-[75px] md:pt-[55px] pt-[45px]">
            <div class="container">
                @if( isset($block2_info) )
                    @foreach ($block2_info->image as $k => $image )
                        <div class="wow fadeInUp">
                            <img src="{{ asset($image) }}" class="inline-block 4xl:h-[77px] 3xl:h-[55px] xl:h-[53px] sm:h-[40px] h-[35px] w-auto object-contain" alt="">
                            <h3 class="font-misslegate 4xl:pl-[180px] 4xl:text-[96px] 4xl:h-[86px] 4xl:leading-[40px] 3xl:h-[45px] 3xl:text-[55px] 3xl:leading-[35px] 3xl:pl-[130px] xl:h-[60px] xl:leading-[31px] xl:text-[76px] 3xl:mt-[28px] xl:mt-[20px] sm:h-[50px] sm:leading-[30px] sm:mt-[15px] sm:text-[60px] text-[50px] h-[38px] leading-[21px] mt-3">{{ $block2_info->title[$k] }}</h3>
                            <div class="4xl:pl-[180px] 3xl:text-f30 3xl:pl-[130px] xl:text-f22 3xl:mt-[21px] xl:mt-[15px] mt-[15px] sm:text-[19px] text-f18 text-color_primary">{{ $block2_info->desc[$k] }}</div>
                        </div>
                    @endforeach
                @endif

                @if( isset($block2_images) )
                    {{-- PC --}}
                    <div class="mt-[50px] relative">
                        <div class="swiper-block-5 swiper-container relative">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="xl:flex hidden gap-[25px] items-center justify-center ">
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
                                    
                                </div>
                            </div>
                        </div>
                        <div class="swiper-prev-5 swiper-ctm absolute top-1/2 translate-y-[-50%] 4xl:left-0 xl:left-[-85px] z-10 2xl:block hidden">
                            <img src="{{ asset('frontend/images/button-left.png') }}" class="4xl:w-auto 3xl:h-[35px]" alt="">
                        </div>
                        <div class="swiper-next-5 swiper-ctm absolute top-1/2 translate-y-[-50%] 4xl:right-0 xl:right-[-85px] z-10 2xl:block hidden">
                            <img src="{{ asset('frontend/images/button-right.png') }}" class="4xl:w-auto 3xl:h-[35px]" alt="">
                        </div>
                        
                    </div>

                    {{-- Tablet/Mobile --}}
                    <div class="xl:hidden block">
                        <div class="swiper-block-2 swiper-container wow fadeInUp">
                            <div class="swiper-wrapper">
                                @foreach ($block2_images->image as $k => $image)
                                    <div class="swiper-slide">
                                        <div class="hover-img 2xl:h-[380px] xl:h-[310px] h-[285px] text-center relative after:content[''] after:bg-[linear-gradient(180deg,rgba(0,0,0,0)_0%,rgba(0,0,0,0.5)_84.47%)] after:absolute after:w-full after:h-full after:top-0 after:left-0 after:rounded-[30px] wow fadeInUp" data-wow-delay="0.6s">
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

        {{-- Block Văn hóa --}}
        @if(isset($isVanHoa) && count($isVanHoa) > 0)
            @foreach ($isVanHoa as $cat)
                @if( isset($cat->posts) )
                    <section class="2xl:mt-[156px] xl:mt-[80px] mt-[55px]">
                        <div class="container">
                            <div class="flex xl:flex-row flex-col 4xl:gap-[75px] 3xl:gap-[70px] xl:gap-[50px] gap-[12px]">
                                <div class="4xl:w-[1315px] 3xl:w-[70%] xl:w-[65%] xl:order-1 order-2 2xl:mt-0 mt-5">
                                    <div class="flex sm:flex-row flex-col 4xl:gap-[20px] gap-[12px] md-hidden-5">
                                        @foreach($cat->posts as $k => $post)
                                            @if( $k == 0 || $k == 1 )
                                                <div class="@if( $k==0 ) 4xl:w-[975px] 3xl:w-[580px] xl:w-1/2 sm:w-1/2 @else flex-1 @endif relative rounded-[30px] overflow-hidden wow fadeInUp" data-wow-delay="0.1s">
                                                    @include('homepage.home.item.item_block_3', ['post' => $post, 'k' => $k, 'height' => '4xl:h-[435px]', 'cat_slug' => $cat->slug, 'cat_title' => $cat->title])
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="flex sm:flex-row flex-col 4xl:gap-[20px] gap-[12px] xl:mt-[20px] lg:mt-[12px] md:mt-[12px] mt-[12px] md-hidden-5">
                                        @foreach($cat->posts as $k => $post)
                                            @if( $k > 1 )
                                                <div class="@if( $k==2 ) 4xl:w-[640px] 3xl:w-[400px] sm:w-1/3 @else flex-1 @endif relative rounded-[30px] overflow-hidden wow fadeInUp" data-wow-delay="0.1s">
                                                    @include('homepage.home.item.item_block_3', ['post' => $post, 'k' => $k, 'height' => '4xl:h-[350px]', 'cat_slug' => $cat->slug, 'cat_title' => $cat->title])
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="flex-1 xl:order-2 order-1 wow fadeInRight" data-wow-duration="1s">
                                    <div class="flex h-full justify-center">
                                        <div class="text-left w-full">
                                            @if( !empty($cat->image) )
                                                <img src="{{ asset($cat->image) }}" class="4xl:h-[333px] 3xl:h-[215px] 2xl:h-[245px] xl:h-[150px] lg:h-[170px] h-[165px] inline-block object-contain object-bottom" alt="">
                                            @endif
                                            <div class="4xl:text-f30 3xl:text-f22 4xl:mt-[85px] 3xl:mt-[55px] sm:mt-[35px] lg:text-justify sm:text-f20 text-16 mt-[20px] ">
                                                {!! $cat->description !!}
                                            </div>
                                            <div class="xl:text-left text-center 2xl:mt-[55px] mt-[35px]">
                                                <a href="">
                                                    <img src="{{ asset('frontend/images/readmore.png') }}" class="2xl:h-auto h-[50px] " alt="">
                                                </a>
                                                <a href="{{ route('routerURL', ['slug' => $cat->slug]) }}" class="hidden lg:mt-[35px] sm:mt-[45px] mt-[20px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary lg:border-[3px] border text-color_primary 3xl:text-f25 sm:text-f22 text-f18 3xl:px-[40px] 3xl:py-[20px] 3xl:rounded-[60px] 2xl:rounded-[50px] 2xl:px-[30px] 2xl:py-[17px] px-[30px] py-[15px] rounded-[30px]">Xem thêm</a>
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

        {{-- Block Vì VN --}}
        @php
            $block3_info = getDataJson($page->fields, 'config_colums_json_home_cout_project');
        @endphp
        @if( isset($block3_info) )
            @foreach( $block3_info->image as $k => $image )
                <section class="3xl:mt-[105px] 3xl:pt-[95px] 3xl:pb-[135px] 2xl:pt-[75px] 2xl:mt-[100px] lg:pt-[50px] lg:mt-[80px] lg:pb-[56px] sm:mt-[70px] sm:pt-[40px] sm:pb-[100px] pt-[100px] pb-[70px]" style="background: url('{{ asset($image) }}');background-repeat: no-repeat;background-repeat: no-repeat;background-size: contain;background-position: bottom;">
                    <div class="container">
                        <div class="text-center wow fadeInUp">
                            <h3 class="3xl:text-[64px] leading-[105%] lg:text-[50px] sm:text-[50px] sm:h-[45px] text-[45px] font-bold italic text-color_primary">{{ $block3_info->title[$k] }}</h3>
                            <h4 class="3xl:h-[78px] leading-[105%] 3xl:text-[96px] lg:text-[75px] lg:h-[60px] text-[78px] h-[65px] sm:text-[80px] sm:h-[115px] font-misslegate">{{ $block3_info->sub_title[$k] }}</h4>
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

        {{-- Block Thành viên --}}
        @if( isset($teamSlide) && $teamSlide->slides->isNotEmpty() )
            <section class="bg-[#f5f5f5] py-[60px]">
                <div class="container">
                    <h3 class="text-center 4xl:text-f40 3xl:text-f30 xl:text-f26 lg:text-f27 sm:text-f23 text-f20">{{ $teamSlide->title }}</h3>
                    <div class="relative lg:mt-[110px] sm:mt-[60px] mt-[50px]">
                        <div class="swiper-block-team swiper-container wow fadeInUp">
                            <div class="swiper-wrapper">
                                @foreach ($teamSlide->slides as $slide)
                                    <div class="swiper-slide text-center">
                                        <div class="4xl:w-[250px] 4xl:h-[250px] 3xl:w-[200px] 3xl:h-[200px] xl:w-[170px] xl:h-[170px] lg:w-[175px] lg:h-[175px] sm:h-[150px] h-[150px] inline-block relative">
                                            <img src="{{ asset($slide->src) }}" class="object-cover w-full h-full rounded-full inline-block" alt="">
                                            <span class="absolute top-0 right-0 border-[2px] border-white sm:w-[60px] sm:h-[60px] h-[30px] w-[30px] flex justify-center items-center rounded-full bg-[#369e74]">
                                                <svg class="w-[25px] h-[25px]" fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 95.333 95.332" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M30.512,43.939c-2.348-0.676-4.696-1.019-6.98-1.019c-3.527,0-6.47,0.806-8.752,1.793 c2.2-8.054,7.485-21.951,18.013-23.516c0.975-0.145,1.774-0.85,2.04-1.799l2.301-8.23c0.194-0.696,0.079-1.441-0.318-2.045 s-1.035-1.007-1.75-1.105c-0.777-0.106-1.569-0.16-2.354-0.16c-12.637,0-25.152,13.19-30.433,32.076 c-3.1,11.08-4.009,27.738,3.627,38.223c4.273,5.867,10.507,9,18.529,9.313c0.033,0.001,0.065,0.002,0.098,0.002 c9.898,0,18.675-6.666,21.345-16.209c1.595-5.705,0.874-11.688-2.032-16.851C40.971,49.307,36.236,45.586,30.512,43.939z"></path> <path d="M92.471,54.413c-2.875-5.106-7.61-8.827-13.334-10.474c-2.348-0.676-4.696-1.019-6.979-1.019 c-3.527,0-6.471,0.806-8.753,1.793c2.2-8.054,7.485-21.951,18.014-23.516c0.975-0.145,1.773-0.85,2.04-1.799l2.301-8.23 c0.194-0.696,0.079-1.441-0.318-2.045c-0.396-0.604-1.034-1.007-1.75-1.105c-0.776-0.106-1.568-0.16-2.354-0.16 c-12.637,0-25.152,13.19-30.434,32.076c-3.099,11.08-4.008,27.738,3.629,38.225c4.272,5.866,10.507,9,18.528,9.312 c0.033,0.001,0.065,0.002,0.099,0.002c9.897,0,18.675-6.666,21.345-16.209C96.098,65.559,95.376,59.575,92.471,54.413z"></path> </g> </g> </g></svg>
                                            </span>
                                        </div>
                                        <div class="text-center description">
                                            <h3 class="4xl:text-f26 3xl:text-f21 xl:text-f18 text-f20 4xl:leading-[36px] 3xl:leading-[29px] font-bold text-[#369e74] my-[40px]">{{ $slide->description }}</h3>
                                            <div class="4xl:text-f20 text-f17 text-[#474747]">{{ $slide->title }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-prev-5 swiper-ctm absolute top-1/2 translate-y-[-50%] 4xl:left-0 xl:left-[-85px] z-10 xl:block hidden">
                            <img src="{{ asset('frontend/images/button-left.png') }}" class="4xl:w-auto 3xl:h-[35px]" alt="">
                        </div>
                        <div class="swiper-next-5 swiper-ctm absolute top-1/2 translate-y-[-50%] 4xl:right-0 xl:right-[-85px] z-10 xl:block hidden">
                            <img src="{{ asset('frontend/images/button-right.png') }}" class="4xl:w-auto 3xl:h-[35px]" alt="">
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- Block BDS --}}
        @if(isset($homeBDS) && count($homeBDS->first()->posts) > 0)
            <section class="lg:mt-[85px] mt-[40px]">
                <div class="container tabBlock">
                    <div class="flex justify-center items-center lg:text-left text-center mb-[45px] wow fadeInUp">
                        <div>
                            <h3 class="font-misslegate 4xl:text-[116px] 4xl:h-[120px] 3xl:text-[100px] 3xl:h-[65px] lg:text-[80px] lg:h-[80px] sm:text-[65px] sm:leading-[60px] text-[60px] leading-[55px]">Điểm tin</h3>
                            <h3 class="font-bold 4xl:text-[72px] 3xl:text-[55px] 2xl:text-[56px] xl:text-[42px] lg:text-[45px] sm:text-[45px] text-[36px] text-color_primary">{{ $homeBDS->first()->title }}</h3>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-2 grid-cols-1 4xl:gap-[35px] 3xl:gap-[25px] xl:gap-[20px] lg:gap-[15px] gap-[15px]">
                        @foreach ($isVanHoa->first()->posts as $post)
                            <div class="flex items-center">
                                <div class="4xl:w-[418px] 3xl:w-[300px] 4xl:h-[265px] 3xl:h-[255px] xl:h-[210px] xl:w-[250px] lg:w-[200px] lg:h-[200px] w-[170px] h-[165px]">
                                    <img src="{{ asset($post->image) }}" class="w-full h-full rounded-[20px] object-cover" alt="">
                                </div>
                                <div class="flex-1 pl-[30px]">
                                    <h3 class="4xl:text-f26 3xl:text-f21 xl:text-f20 font-bold mb-[20px]"><a href="{{ route('routerURL', ['slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
                                    <div class="text-[#383737] 4xl:text-f18">
                                        {{ date('d/m/Y', strtotime($post->created_at)) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </section>
        @endif

        {{-- Block Multimedia --}}
        @if( isset($homeMedia) && count($homeMedia->children) )
            <section class="xl:mt-[110px] mt-[50px] mb-[80px]">
                <div class="container">
                    <div class="xl:flex 4xl:gap-[170px] 3xl:gap-[100px] 2xl:gap-[85px] xl:gap-[50px] mt-[22px] tabBlock">
                        <div class="flex-1 lg:flex 2xl:justify-left justify-center items-center wow fadeInLeft">
                            <div>
                                <h3 class="4xl:text-[126px] 3xl:text-[100px] 3xl:leading-[92px] 2xl:text-[110px] lg:leading-[50px] xl:text-[65px] xl:leading-[60px] sm:leading-[50px] leading-[40px] xl:text-left text-center sm:text-[54px] text-[36px] font-bold uppercase 4xl:leading-[105px] 2xl:leading-[100px]">
                                    <div class="text-[#b5b5b5]">MULTI</div>
                                    <div class="text-color_primary">MEDIA</div>
                                </h3>
                                <div class="2xl:mt-[35px] xl:mt-[40px] mt-[30px]">
                                    <ul class="tabBlock-tabs xl:text-left text-center 2xl:text-f18 xl:text-f16">
                                        @foreach( $homeMedia->children as $k => $cat )
                                            <li class="inline-block"><a href="javascript:void(0)" data-tab="data-tab-{{ $k }}" class="tabBlock-tab border @if( $k ==0 ) border-color_primary bg-color_primary text-white @else border-black @endif rounded-[115px] 2xl:mr-[20px] mr-[15px] 2xl:py-[8px] py-[3px] px-[14px] inline-block hover:bg-color_primary hover:text-white hover:border-color_primary duration-300">{{ $cat->title }}</a></li>
                                        @endforeach
                                    </ul>
                                    <div class="xl:text-left text-center">
                                        <a href="" class="inline-block mt-[30px]">
                                            <img src="{{ asset('frontend/images/readmore.png') }}"  class="2xl:h-auto h-[50px] " alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="4xl:w-[1400px] 3xl:w-[850px] 2xl:w-[880px] xl:w-[700px] xl:mt-0 mt-[30px] w-full wow fadeInRight">
                            <div class="tabBlock-content">
                                @foreach( $homeMedia->children as $k => $cat )
                                    <div class="tabBlock-pane relative" id="data-tab-{{$k}}" @if($k>0) style="display: none" @endif>
                                        <div class="swiper-block-media swiper-container">
                                            <div class="swiper-wrapper">
                                                @php
                                                    $cutMedia = $cat->listMedia->chunk(3)->map(function ($chunk) {
                                                        return $chunk->toArray();
                                                    })->toArray();
                                                @endphp
                                                @if( isset($cutMedia) && is_array($cutMedia) && count($cutMedia) )
                                                    @foreach ($cutMedia as $item)
                                                        <div class="swiper-slide">
                                                            <div class="flex gap-[15px]">
                                                                @foreach ($item as $k => $media)
                                                                    @if( $k == 0 )
                                                                        <div class="4xl:w-[930px] 3xl:w-[600px] xl:w-[65%] lg:w-[60%] w-1/2">
                                                                            <div class="relative">
                                                                                <img src="{{ asset( $media['image']) }}" class="w-full 4xl:h-[590px] 3xl:h-[460px] xl:h-[360px] sm:h-[400px] h-[300px] rounded-[20px] object-cover" alt="">
                                                                                <a href="{{ $media['video_iframe'] }}" data-fancybox="" class="absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]">
                                                                                    <img src="/upload/images/logo/icon-play.png" alt="" class="4xl:w-auto 3xl:h-[50px] h-[40px]">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <div class="flex-1 grid grid-cols-1 gap-[15px]">
                                                                    @foreach ($item as $k => $media)
                                                                        @if( $k > 0 )
                                                                            <div class="relative">
                                                                                <img src="{{ asset( $media['image']) }}" class="w-full 4xl:h-[285px] 3xl:h-[220px] xl:h-[170px] lg:h-[175px] sm:h-[190px] h-[140px] rounded-[20px] object-cover" alt="">
                                                                                <a href="{{ $media['video_iframe'] }}" data-fancybox="" class="absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]">
                                                                                    <img src="/upload/images/logo/icon-play.png" alt="" class="4xl:w-auto 3xl:h-[50px] h-[40px]">
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="swiper-prev-media swiper-ctm absolute top-1/2 translate-y-[-50%] 4xl:left-[-85px] xl:left-[-85px] z-10 xl:block hidden">
                                            <img src="{{ asset('frontend/images/button-left.png') }}" class="4xl:w-auto 3xl:h-[35px]" alt="">
                                        </div>
                                        <div class="swiper-next-media swiper-ctm absolute top-1/2 translate-y-[-50%] 4xl:right-[-85px] xl:right-[-85px] z-10 xl:block hidden">
                                            <img src="{{ asset('frontend/images/button-right.png') }}" class="4xl:w-auto 3xl:h-[35px]" alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        
    </div>
@endsection
@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
         $(document).ready(function() {
            Fancybox.bind("[data-fancybox]", {
                // Your Fancybox options here
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var swipers = [];
            $('.swiper-block-media').each(function(index, element) {
                var swiper = new Swiper(element, {
                    loop: true,
                    slidesPerView: 1,
                    spaceBetween: 20,
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
            
            // var swiperMedia = new Swiper(".swiper-block-media", {
            //     loop: true,
            //     slidesPerView: 1,
            //     spaceBetween: 20,
            //     navigation: {
            //         nextEl: ".swiper-prev-media",
            //         prevEl: ".swiper-next-media",
            //     },
            // });

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

            var mySwiper = new Swiper('.swiper-block-5', {
                loop: true,
                navigation: {
                    nextEl: ".swiper-prev-5",
                    prevEl: ".swiper-next-5",
                },
                slidesPerView: 1,
                centeredSlides: true,
                spaceBetween: 30, // khoảng cách ngang đều nhau
                on: {
                    slideChangeTransitionEnd: function () {
                    this.slides.forEach(slide => {
                        slide.classList.remove('prev-2', 'prev-1', 'next-1', 'next-2');
                    });

                    const active = this.activeIndex;
                    const slides = this.slides;

                    slides[active - 2]?.classList.add('prev-2');
                    slides[active - 1]?.classList.add('prev-1');
                    slides[active + 1]?.classList.add('next-1');
                    slides[active + 2]?.classList.add('next-2');
                    }
                }
            });

            var swiperBlockTeam = new Swiper(".swiper-block-team.swiper-container", {
                loop: true,
                speed: 1000, // tốc độ chuyển slide (ms)
                slidesPerView: 5,
                // spaceBetween: 20,
                navigation: {
                    nextEl: ".swiper-prev-team",
                    prevEl: ".swiper-next-team",
                },
                centeredSlides: true,
                // autoplay: {
                //     delay:2000,
                //     disableOnInteraction: false,
                // },
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
                    1366: {
                        slidesPerView: 5
                    },
                }
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

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.min.css">
@endpush
