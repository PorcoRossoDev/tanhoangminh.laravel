@extends('homepage.layout.home')
@section('content')

@php
    $slide = getDataJson($page->fields, 'config_colums_json_home_slide_main');
@endphp


    @if (isset($slide) && count($slide->image))
        <section class="home-slider wow fadeInUp">
            <div class="swiper">
                <div class="swiper-wrapper h-auto">
                    @foreach ($slide->image as $key => $v)
                        <div class="swiper-slide overflow-hidden">
                            <div class="item lg:h-[830px] md:h-[400px] h-[300px] relative">
                                <div class="bg-layer" style="background: url({{ asset($v) }}) center/cover no-repeat">
                                </div>
                                <div class="container mx-auto px-3 flex items-center h-full">
                                    <div class="content">
                                        <div class="first">
                                            <p
                                                class="inline-block bg-[#00000033] max-w-[570px] font-playfair lg:text-[60px] md:text-[40px] text-[30px] p-[10px] lg:leading-[70px] md:leading-[45px] leading-[35px] font-bold rounded-lg">
                                                {!! $slide->title[$key] !!}
                                            </p>
                                        </div>
                                        <div class="first w-[60px] h-[3px] bg-color_primary my-10 lg:block hidden"></div>
                                        <div class="second lg:block hidden">
                                            <p
                                                class="inline-block bg-[#00000033] max-w-[570px] text-[18px] p-[10px] rounded-lg">
                                                {!! $slide->desc[$key] !!}
                                            </p>
                                        </div>
                                        <a href="{{$slide->link[$key]}}"
                                            class="third inline-block mt-10 uppercase border-white duration-300 border-2 px-[30px] py-[10px] rounded-3xl hover:text-white bg-white !text-color_primary">Book
                                            now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
    @endif

    @include('homepage.common.promotion')

    @include('homepage.common.why')

    @include('homepage.common.our', $homeServices)

    @include('homepage.common.testimonial')

    @include('homepage.common.polifo')

    @if( $homeNews )
        @foreach($homeNews as $cat )
            @if( $cat->posts )
                <section class="home-news xl:py-[110px] md:py-[70px] py-[50px] wow fadeInUp">
                    <div class="container mx-auto px-3">
                        <h2 class="font-bold text-color_primary font-playfair xl:text-[48px] lg:text-[30px] text-[30px] text-center wow fadeInUp">
                            {{ $cat->title }}
                        </h2>
                        <div
                            class="after:content-[''] after:w-[90px] after:my-4 after:h-[3px] after:bg-color_primary after:mx-auto after:block is-divider relative">
                        </div>
                        <div class="mt-[50px]">
                            <div class="swiper-container md:py-10 wow fadeInUp">
                                <div class="swiper-wrapper h-auto">
                                    @foreach ($cat->posts as $post)
                                        <div class="swiper-slide">
                                            <a href="{{ route('routerURL', ['slug' => $post->slug]) }}">
                                                <img src="{{ !empty($post->image) ? asset($post->image) : asset('images/404.png') }}" class="h-[300px] object-cover w-full" alt="{{ $post->title }}">
                                            </a>
                                            <div class="text-center">
                                                <h4 class="mt-4"><a href="{{ route('routerURL', ['slug' => $post->slug]) }}" class="font-bold leading-[28px] text-f18">{{ $post->title }}</a></h4>
                                                <p class="mt-3 text-[#9B9B9B]" style="
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                                -webkit-box-orient: vertical;
                                                display: -webkit-box;
                                                -webkit-line-clamp: 3;
                                            ">{{ strip_tags($post->description) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('routerURL', ['slug' => $cat->slug]) }}" class="third inline-block mt-10 uppercase border-color_primary border-2 px-[30px] py-[10px] rounded-3xl text-[14px] text-color_primary duration-300 hover:text-white hover:bg-color_primary">View All</a>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    @include('homepage.common.work')

    @include('homepage.common.map')

@endsection

@push('javascript')
    <script>
        $(document).ready(function() {
            var slider = new Swiper('.home-slider .swiper', {
                effect: 'fade',
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 7000,
                    disableOnInteraction: false
                },
                loop: true,
                observer: true,
                observeParents: true,
                speed: 500,
                on: {
                    afterInit: function() {
                        document.querySelector(".swiper-slide-active").classList.add("bganimation");
                    },
                    activeIndexChange: function () {
                        setTimeout(function(){
                            document.querySelectorAll(".swiper-slide:not(.swiper-slide-active)")
                                .forEach(el => el.classList.remove("bganimation"));
                        }, 500);
                        document.querySelectorAll(".swiper-slide").forEach(el => el.classList.add("bganimation"));
                    },
                }
            });
            
            var swiperNews = new Swiper(".home-news .swiper-container", {
                loop: true,
                lazy: {
                    loadPrevNext: true,
                    loadOnTransitionStart: true,
                },
                spaceBetween: 30,
                pagination: {
                    el: ".home-news .swiper-pagination",
                    clickable: true
                },
                navigation: {
                    nextEl: '.home-news .swiper-button-next',
                    prevEl: '.home-news .swiper-button-prev',
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1
                    },
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    }
                }
            });
        })

    </script>
@endpush
