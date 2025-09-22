@extends('homepage.layout.home')
@section('content')

<div class="main-page tabBlock">
    <div class="container">
        <div class="text-center mt-[70px]">
            <div class="lg:w-[795px] inline-block">
                <div class="font-misslegate text-[70px]">Đội ngũ</div>
                <div class="uppercase text-[50px] text-color_primary font-bold relative mt-[-30px]">ban lãnh đạo</div>
            </div>
            @if(isset($tags))
                <ul class="mt-[35px] tabBlock-tabs">
                    @foreach( $tags as $k => $cat )
                        <li class="inline-block">
                            <a href="javascript:void(0)" data-tab="data-tabs-{{ $k }}" class="tabBlock-tab border @if( $k ==0 ) border-color_primary bg-color_primary text-white @else border-black @endif rounded-[115px] text-f18 xl:mr-[20px] mr-[10px] xl:mb-[15px] mb-[10px] py-[7px] px-[14px] inline-block hover:bg-color_primary hover:text-white hover:border-color_primary duration-300">{{$cat->title}}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="tabBlock-content md:mt-[100px] mt-[80px]">
            @foreach( $tags as $k => $cat )
            <div class="tabBlock-pane" id="data-tabs-{{$k}}" @if($k>0) style="display: none" @endif>
                @foreach($cat->experts as $post)
                    @php
                        $chucvu = showField($post->fields, 'config_colums_input_chuyengia_chucvu');
                        $namsinh = showField($post->fields, 'config_colums_input_chuyengia_namsinh');
                    @endphp
                    <div class="md:flex lg:gap-[155px] md:gap-[20px] mb-[50px] md:mt-0 mt-3 border-b border-b-[#000] pb-[50px]">
                        <div class="lg:w-[305px] md:w-[240px]">
                            <img src="{{ asset($post->image) }}" class="w-full h-[305px] rounded-[20px] object-cover" alt="">
                        </div>
                        <div class="flex-1">
                            <div>
                                <div class="font-bold 2xl:text-[40px] md:text-f31 text-f23 md:mt-0 mt-3 uppercase ">{{ $post->title }}</div>
                                <div class="italic 2xl:text-f24 md:text-f21 text-f20 xl:mt-[15px] text-color_primary">Chức vụ: {{ $chucvu }}</div>
                                <div class="2xl:text-f24 md:text-f22 text-f20 xl:mt-[24px] mt-1">
                                    <span class="font-bold">Sinh năm:</span>
                                    <span>{{ $namsinh }}</span>
                                </div>
                                <div class="md:text-f20 text-f18 xl:mt-[35px] mt-2">
                                    <div class="text-color_primary font-bold">Trình độ chuyên môn:</div>
                                    <div class="text-[#2B2B2B] mt-2 desc" style="
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        -webkit-box-orient: vertical;
                                        -webkit-line-clamp: 3;
                                        display: -webkit-box;
                                    ">
                                        {!! $post->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
    @media (max-width: 1024px) {
        .desc{
            -webkit-line-clamp: 6!important;
        }
    }
</style>
@endpush

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
@endpush
