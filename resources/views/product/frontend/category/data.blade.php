@if( !empty($detail->images) )
    <section class="border-t wow fadeInUp">
        <img src="{{ $detail->images }}" class="w-full" alt="">
    </section>
@endif
@if( isset($data) && count($data) )
    <section class="wow fadeInUp">
        <ul class="border-b flex items-center justify-center py-2">
            <li class="mb-1.5 md:mr-2 mr-1.5">
                <form action="" id="home-filters" class="relative">
                    <svg class="MuiSvgIcon-root absolute icon left-2 nlcolor" focusable="false" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" style="top: 7px;"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>
                    <input type="text" name="keyword" data-filter="change" placeholder="{{  trans('index.SearchBox') }}" class="border border-black h-[36px] pl-8 rounded text-black text-f14 w-60">
                    <input type="hidden" name="attr" data-filter="change" value="">
                    <input type="hidden" name="catalogueid" value="{{ $detail->id }}">
                </form>
            </li>
            @if( $attributes && count($attributes) )
                @foreach( $attributes as $k => $v )
                <li class="border border-black md:mr-2 mr-1.5 mb-1.5 px-4 py-1.5 rounded md:text-f16 text-f14">
                    <a href="javascript:void(0)" data-modal-target="static-modal-{{ $k }}" data-modal-toggle="static-modal-{{ $k }}" type="button">{{ $k }}</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </section>

    <section class="wow fadeInUp">
        <div class="mx-auto pl-4 pr-4 relative px-2">
            <div class="md:flex flex-wrap justify-center mx-[-5px] mt-[10px]" id="render-filters">
                @foreach( $data as $v )
                <div class="xl:w-1/4 lg:w-1/3 md:w-1/2 w-full px-[5px] mb-[10px]">
                    {!! htmlItemProduct($v) !!}
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endif


@if( $attributes && count($attributes) )
    @foreach( $attributes as $k => $v )
        <div id="static-modal-{{ $k }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="max-h-full max-w-[540px] p-4 relative w-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $k }}
                        </h3>
                    </div>
                    <div class="flex flex-wrap items-baseline justify-center md:p-5 p-4">
                        @if( $v )
                            @foreach( $v as $attr )
                                <div class="item-filter inline-block">
                                    <div for="label-{{ $attr['id'] }}" class="label-box border border-color_primary cursor-pointer flex items-center mr-3 px-3 py-1 rounded mb-2">
                                        <input id="label-{{ $attr['id'] }}" class="mr-2" type="checkbox" name="{{ $attr['keyword'] }}" value="{{ $attr['id'] }}"> {{ $attr['titleC'] }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-target="static-modal-{{ $k }}" data-modal-toggle="static-modal-{{ $k }}" class="block border border-blue-900 px-5 py-2.5 rounded text-center text-sm text-whiterounded-lg w-full" type="button">
                            {{ trans('index.Back') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif