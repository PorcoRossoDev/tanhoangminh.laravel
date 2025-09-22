@extends('homepage.layout.home')

@section('content')

    <?php
        $price = getPrice(['price' => $detail->price, 'price_sale' => $detail->price_sale, 'price_contact' => $detail->price_contact]);
        $listAlbums = json_decode($detail->image_json, true);
    ?>

    {{-- Detail --}}
    <div id="main" class="sitemap main-product-detail pb-[30px] main">
        {!! htmlBreadcrumb($detail->title, $breadcrumb) !!}
        <div class="content-product-detail pt-[30px]">
            <div class="container mx-auto pl-4 pr-4">

                @include('product.frontend.product.common.detail')
            
                <!-- start: box 5 -->
                <section class="mt-[30px] md:mt-[60px] description-section wow fadeInUp">
                    <div class="tab-detail">
                        <nav class="tabs flex justify-start">
                            <button data-target="panel-1"
                                class="px-[10px] bg-black py-[10px] md:px-[15px] text-f16 text-white font-medium mr-2 tab active block hover:text-green focus:outline-none" style="min-width: 150px;">
                                {{ trans('index.InfomationTap') }}
                            </button>
                            <button data-target="panel-2"
                                class="px-[10px] bg-black py-[10px] md:px-[15px] text-f16 text-white font-medium tab block hover:text-green focus:outline-none" style="min-width: 150px;">
                                {{ trans('index.Specifications') }}
                            </button>
                        </nav>
                    </div>

                    <div id="panels" class="p-[10px] md:p-[20px] bg-white border border-gray-100">
                        <div class="panel-1 tab-content active">
                            <div class="content-content">
                                {!! $detail->content !!}
                            </div>
                        </div>
                        <div class="panel-2 tab-content">
                            <div class="content-content">
                                {!! showField($detail->fields, 'config_colums_editor_product_specifications') !!}
                            </div>
                        </div>
                    </div>
                </section>
                <!-- end: box5 -->
                @if ( isset($productSame) && !empty($productSame) && count($productSame) )
                    <div class="other-product mt-[20px] md:mt-[40px]">
                        <h2 class="title-primary uppercase text-green text-f20 md:text-f30 font-medium text-center leading-[30px] md:leading-[40px] relative pb-[20px]">
                            {{ trans('index.RelatedProducts') }}
                        </h2>
                        <div class="slider-raleted-product owl-carousel mt-7">
                            @foreach ($productSame as $vC)
                                <div class="item mt-3">
                                    <div
                                        class="box-shadow-custom bg-white border border-gray-100 duration-300 ease-in-out group hover:transform hover:translate-y-[-10px] item mb-[10px] md:mb-[30px] p-2 relative shadow transition">
                                        <div class="img hover-zoom">
                                            <a href="{{ route('routerURL', ['slug' => $vC->slug]) }}">
                                                <img src="{{ asset($vC->image) }}" class="w-full h-175px object-cover"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div
                                            class="bg-white bottom-0 duration-300 ease-in-out last:border-00 md:px-3 md:py-3 md:text-center px-2 py-2 text-black transition">
                                            <h3 class="mb-2 md:my-3 mt-0.5"><a
                                                    href="{{ route('routerURL', ['slug' => $vC->slug]) }}"
                                                    class="font-medium text-f18"
                                                    style="
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        -webkit-line-clamp: 2;
                                        -webkit-box-orient: vertical;
                                        display: -webkit-box;
                                    ">{{ $vC->title }}</a>
                                            </h3>
                                            <div class="leading-[24px]"
                                                style="
                                overflow: hidden;
                                text-overflow: ellipsis;
                                -webkit-line-clamp: 3;
                                -webkit-box-orient: vertical;
                                display: -webkit-box;
                            ">
                                                {!! $vC->description !!}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('javascript')
    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
    <script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script>
        //hieu ung wow------------------------------------------
        wow = new WOW({
            animateClass: "animated",
            offset: 100,
            callback: function(box) {
                console.log("WOW: animating <" + box.tagName.toLowerCase() + ">");
            },
        });
        wow.init();

        const sliderThumbs = new Swiper(".slider__thumbs .swiper-container", {
            direction: "vertical",
            slidesPerView: 4,
            spaceBetween: 10,
            navigation: {
                nextEl: ".slider__next",
                prevEl: ".slider__prev",
            },
            freeMode: true,
            breakpoints: {
                0: {
                    direction: "horizontal",
                },
                768: {
                    direction: "horizontal",
                },
            },
        });
        const sliderImages = new Swiper(".slider__images .swiper-container", {
            direction: "vertical",
            slidesPerView: 1,
            spaceBetween: 32,
            mousewheel: true,
            navigation: {
                nextEl: ".slider__next",
                prevEl: ".slider__prev",
            },
            grabCursor: true,
            thumbs: {
                swiper: sliderThumbs,
            },
            breakpoints: {
                0: {
                    direction: "horizontal",
                },
                768: {
                    direction: "vertical",
                },
            },
        });
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}" />
@endpush
