@extends('homepage.layout.home')
@section('content')

<div class="main-page">

    @php
        $block1 = getDataJson($page->fields, 'config_colums_json_trachnhiem_title');
        $block2 = getDataJson($page->fields, 'config_colums_json_trachnhiem_data');

        $isNews = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'image', 'description')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'highlight' => 1])
            ->with(['posts'])
            ->orderBy('order', 'asc')
            ->first();

    @endphp

    @if($block1 && $block1->image)
        @foreach($block1->image as $k => $img )
            <div class="relative">
                <img src="{{asset($img)}}" class="w-full lg:h-[100vh] h-[50vh] object-cover" alt="">
                <div class="absolute text-center top-[40px] left-1/2 translate-x-[-50%]">
                    <div class="container">
                        <h1 class="font-bold italic text-color_primary xl:text-[91px] md:text-[41px] text-f35">{{$block1->title[$k]}}</h1>
                        <h2 class="font-misslegate xl:text-[137px] text-[82px] mt-[-50px]">{{$block1->desc[$k]}}</h2>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if($block2 && $block2->image)
        @foreach($block2->image as $k => $img )
            @if($k%2==0)
            <div class="relative">
                <img src="{{asset($img)}}" class="w-full lg:h-full md:h-[500px] h-[700px] object-cover" alt="">
                <div class="absolute h-full left-0 top-0 w-full">
                    <div class="container">
                        <div class="flex justify-end">
                            <div class="w-[459px] lg:mr-[130px] pt-[115px]">
                                <h3 class="text-[#811317] font-bold xl:text-[36px] lg:text-f29 text-f26">{{$block2->title[$k]}}</h3>
                                <div class="mt-[23px] xl:text-f26 text-f23">
                                    <!-- <ul class="list-disc pl-[15px]">
                                        <li>Hài hòa lợi ích kinh tế với trách nhiệm xã hội và môi trường</li>
                                        <li>Kiến tạo tương lai thịnh vượng, gắn kết và trường tồn</li>
                                    </ul> -->
                                    {!! $block2->desc[$k] !!}
                                </div>
                                <a href="{{$block2->url[$k]}}" class="inline-block mt-[23px] border-[3px] lg:border-color_primary rounded-[59px] bg-white text-color_primary font-bold lg:text-[25px] text-f23 px-[40px] py-[20px] lg:text-color_primary">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="relative">
                <img src="{{asset($img)}}" class="w-full lg:h-full md:h-[500px] h-[700px] object-cover" alt="">
                <div class="absolute h-full left-0 top-0 w-full">
                    <div class="container">
                        <div class="flex justify-start">
                            <div class="w-[459px] lg:ml-[130px] pt-[115px]">
                                <h3 class="text-[#811317] font-bold xl:text-[36px] lg:text-f29 text-f26">{{$block2->title[$k]}}</h3>
                                <div class="mt-[23px] xl:text-f26 text-f23">
                                    <!-- <ul class="list-disc pl-[15px]">
                                        <li>Chung tay hỗ trợ cộng đồng vượt qua khó khăn, thiên tai.</li>
                                        <li>Lan tỏa yêu thương, vun đắp những giá trị nhân văn bền vững.</li>
                                    </ul> -->
                                    {!! $block2->desc[$k] !!}
                                </div>
                                <a href="{{$block2->url[$k]}}" class="inline-block mt-[23px] border-[3px] lg:border-color_primary rounded-[59px] bg-white text-color_primary font-bold lg:text-[25px] text-f23 px-[40px] py-[20px] lg:text-color_primary">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    @endif

    @if(isset($isNews))
        <section class="mt-[85px]">
            <div class="container tabBlock">
                <div class="xl:flex justify-between items-center lg:text-left text-center mb-[45px] wow fadeInUp">
                    <h3 class="font-bold 3xl:text-[64px] 2xl:text-[56px] sm:text-[54px] text-[36px] lg:mt-0 mt-[40px]">{{ $isNews->title }}</h3>
                </div>
                <div class="md:mt-0 mt-[40px]">
                    <div class="tabBlock-pane">
                        
                        <div class="grid grid-cols-12 gap-[10px]">
                            @foreach( $isNews->posts as $k => $post )
                                <div class="@if( $k==0 ) 2xl:col-span-6 @elseif($k>0 && $k<3) 2xl:col-span-3 @else 2xl:col-span-4  @endif lg:col-span-4 sm:col-span-6 col-span-12 relative rounded-[30px] overflow-hidden">
                                    <div class="relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
                                        <img src="{{asset($post->image)}}" class="@if( $k<3 ) h-[360px]  @else h-[255px]  @endif w-full object-cover object-bottom" alt="">
                                    </div>
                                    <ul class="absolute inline-flex left-[22px] z-10 top-[27px]">
                                        <li class="border py-[3px] px-[12px] text-f16 text-white rounded-[100px] hover:bg-white hover:text-color_primary duration-300"><a href="{{route('routerURL', ['slug' => $isNews->slug])}}">{{$isNews->title}}</a></li>
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
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-[30px] wow fadeInUp" data-wow-delay="0.8s">
                    <a href="" class="inline-block lg:mt-[55px] sm:mt-[45px] mt-[20px] hover:bg-color_primary hover:text-white duration-300 font-bold border-color_primary lg:border-[3px] border text-color_primary 3xl:text-f25 sm:text-f22 text-f18 3xl:px-[40px] 3xl:py-[20px] 3xl:rounded-[60px] 2xl:rounded-[50px] 2xl:px-[30px] 2xl:py-[17px] px-[30px] py-[15px] rounded-[30px]">Xem thêm</a>
                </div>
            </div>
        </section>
    @endif

</div>

@endsection
