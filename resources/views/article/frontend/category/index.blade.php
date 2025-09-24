@extends('homepage.layout.home')
@section('content')

<div class="main-page">
    <div class="container">
        <div class="grid grid-cols-12 xl:gap-[50px] lg:mt-[80px] mt-[50px]">
            <div class="xl:col-span-8 col-span-12">
                <h3 class="font-bold xl:text-[40px] lg:text-f34 text-f31 uppercase mb-8 wow fadeInUp">{{ $detail->title }}</h3>
                @if( $data && $data->isNotEmpty() )
                    @foreach ($data as $k => $post)
                        <div class="lg:flex mb-[30px] border-b border-[#ddd] pb-[30px] wow fadeInUp">
                            <div class="@if($k==0)  xl:w-[60%] @else xl:w-[30%] @endif lg:w-[35%]">
                                <a href="{{ route('routerURL', ['slug' => $post->slug]) }}" class="block hover-img overflow-hidden rounded-[30px]">
                                    <img src="{{ asset($post->image) }}" class="w-full @if($k==0) 2xl:h-[380px] xl:h-[245px] @else lg:h-[245px] h-[300px] @endif object-cover" alt="">
                                </a>
                            </div>
                            <div class="flex-1 lg:pl-[30px] lg:mt-0 mt-4">
                                <h3 class="xl:text-f28 lg:text-f25 text-f23 font-bold mb-4"><a href="{{ route('routerURL', ['slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
                                <ul class="flex items-center">
                                    <li class="inline-flex items-center">
                                        <span>
                                            <svg width="23" height="14" viewBox="0 0 23 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.2493 0.0612793C7.01417 0.0612793 3.17349 2.37129 0.339458 6.12337C0.108201 6.43077 0.108201 6.86023 0.339458 7.16763C3.17349 10.9242 7.01417 13.2342 11.2493 13.2342C15.4845 13.2342 19.3252 10.9242 22.1592 7.17215C22.3905 6.86475 22.3905 6.43529 22.1592 6.12789C19.3252 2.37129 15.4845 0.0612793 11.2493 0.0612793ZM11.5532 11.2859C8.7418 11.4622 6.42016 9.15216 6.597 6.34488C6.7421 4.03035 8.6239 2.15431 10.9455 2.00965C13.7569 1.83335 16.0785 4.14336 15.9017 6.95064C15.7521 9.26065 13.8703 11.1367 11.5532 11.2859ZM11.4126 9.14312C9.89808 9.23805 8.64657 7.99489 8.74633 6.48502C8.82342 5.23734 9.83914 4.22925 11.0906 4.14788C12.6052 4.05295 13.8567 5.29611 13.7569 6.80598C13.6753 8.05818 12.6596 9.06627 11.4126 9.14312Z" fill="#222222"/>
                                            </svg>
                                        </span>
                                        <span class="inline-block ml-[18px]">{{ $post->viewed }}</span>
                                    </li>
                                    <li class="inline-flex ml-[45px] items-center">
                                        <span>
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_581_1521)">
                                                <path d="M9.41604 1.0343C4.59129 1.0343 0.666039 4.55616 0.666039 8.88521C0.666039 10.3984 1.14612 11.8642 2.05671 13.1317C1.88433 15.0325 1.42233 16.4436 0.751497 17.1121C0.662831 17.2005 0.640664 17.3357 0.696664 17.4473C0.746247 17.5471 0.848331 17.6084 0.957706 17.6084C0.971122 17.6084 0.984539 17.6076 0.998247 17.6055C1.11637 17.5889 3.86037 17.1952 5.84516 16.0531C6.97216 16.5064 8.17266 16.7361 9.41604 16.7361C14.2408 16.7361 18.166 13.2143 18.166 8.88521C18.166 4.55616 14.2408 1.0343 9.41604 1.0343ZM5.33271 10.0483C4.68929 10.0483 4.16604 9.52665 4.16604 8.88521C4.16604 8.24376 4.68929 7.72211 5.33271 7.72211C5.97612 7.72211 6.49937 8.24376 6.49937 8.88521C6.49937 9.52665 5.97612 10.0483 5.33271 10.0483ZM9.41604 10.0483C8.77262 10.0483 8.24937 9.52665 8.24937 8.88521C8.24937 8.24376 8.77262 7.72211 9.41604 7.72211C10.0595 7.72211 10.5827 8.24376 10.5827 8.88521C10.5827 9.52665 10.0595 10.0483 9.41604 10.0483ZM13.4994 10.0483C12.856 10.0483 12.3327 9.52665 12.3327 8.88521C12.3327 8.24376 12.856 7.72211 13.4994 7.72211C14.1428 7.72211 14.666 8.24376 14.666 8.88521C14.666 9.52665 14.1428 10.0483 13.4994 10.0483Z" fill="#222222"/>
                                                </g>
                                                <defs>
                                                <clipPath id="clip0_581_1521">
                                                <rect width="17.5" height="17.4465" fill="white" transform="translate(0.666016 0.598145)"/>
                                                </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                        <span class="inline-block ml-[18px]">{{ $post->comments_count }}</span>
                                    </li>
                                </ul>
                                <div class="mt-[30px]"  style="
                                overflow: hidden;
                                text-overflow: ellipsis;
                                -webkit-line-clamp: 4;
                                -webkit-box-orient: vertical;
                                display: -webkit-box;
                            ">{!! $post->description !!}</div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4 pagenavi wow fadeInUp">
                        {!! $data->links() !!}
                    </div>
                @endif
            </div>
            <div class="xl:col-span-4 col-span-12">
                @if($noibat && $noibat->isNotEmpty())
                    @foreach($noibat as $cat)
                        <h3 class="font-extrabold xl:text-[30px] lg:text-f34 text-f31 uppercase wow fadeInUp">{{ $cat->title }}</h3>
                        <div class="xl:mt-[50px] mt-[30px]">
                            @foreach ($cat->posts as $post)
                            <div class="md:flex gap-[25px] mb-[33px] wow fadeInUp">
                                <div class="md:w-[230px] overflow-hidden rounded-[20px]">
                                    <a href="{{route('routerURL', ['slug' => $post->slug])}}" class="hover-img">
                                        <img src="{{asset($post->image)}}" class="w-full h-[200px] object-cover rounded-[20px]" alt="">
                                    </a>
                                </div>
                                <div class="flex-1 md:mt-0 mt-4">
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
                @if($bannerTop && $bannerTop->slides->isNotEmpty())
                    @foreach ($bannerTop->slides as $slide)
                        <div class="mb-4 hover-img rounded-[30px] wow fadeInUp">
                            <a href="{{ $slide->link }}"><img src="{{ asset($slide->src) }}" class="w-full" alt=""></a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>


@endsection