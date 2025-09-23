<?php
$menu_header = getMenus('menu-header');
if( isset(Auth::guard('customer')->user()->id) ){
    $customerLogin = [
        'text' => Auth::guard('customer')->user()->name,
        'url' => route('customer.dashboard')
    ];
} else {
    $customerLogin = [
        'text' => 'Đăng nhập',
        'url' => route('customer.login')
    ];
}
?>

<header id="header" class="site-header my-[30px]">
    <div class="main-menu">
        <div class="menu-box">
            <div class="container">
                <div class="mobile" style="display:none">
                    <a href="javascript:void(0)" class="toggle hc-nav-trigger hc-nav-1">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
                        <path d="M 0 7.5 L 0 12.5 L 50 12.5 L 50 7.5 Z M 0 22.5 L 0 27.5 L 50 27.5 L 50 22.5 Z M 0 37.5 L 0 42.5 L 50 42.5 L 50 37.5 Z"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="container ">
                <div class="flex items-center justify-between nav-container">
                    <div class="mr-4">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset($fcSystem['homepage_logo']) }}" alt="" class="h-[85px] logo object-contain">
                        </a>
                    </div>
                    <nav class="menu font-bold hc-nav-original hc-nav-1" id="main-nav">
                        <ul class="xl:flex 3xl:text-f20 2xl:text-f18 xl:whitespace-nowrap xl:uppercase xl:gap-10">
                            @if( isset($menu_header) && isset($menu_header->menu_items) )
                                @foreach ($menu_header->menu_items as $item)
                                    <li>
                                        <a href="{{ url($item->slug) }}">{{$item->title }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </nav>
                    <a href="javascript:void(0)" class="inline-block xl:hidden toggle-nav">
                        <img src="{{ asset('frontend/images/bar.svg') }}" alt="">
                    </a>
                    <a href="{{ $customerLogin['url'] }}" class="xl:inline-flex hidden ml-4 border-2 border-color_primary rounded-[42px] h-[54px] 2xl:px-[12px] px-[15px] w-[190px] flex items-center justify-center">
                        <div class="3xl:w-[35px] 2xl:w-[30px] w-[35px]">
                            <svg class="" width="37" height="44" viewBox="0 0 37 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.8975 7.61545C10.9531 7.61545 4.51285 14.0557 4.51285 22.0001C4.51285 29.9444 10.9531 36.3847 18.8975 36.3847C26.8418 36.3847 33.2821 29.9444 33.2821 22.0001C33.2821 18.5732 32.0855 15.4294 30.0861 12.9586C29.6317 12.3972 29.7185 11.5737 30.28 11.1194C30.8414 10.6651 31.6649 10.752 32.1191 11.3134C34.4815 14.2328 35.8975 17.9528 35.8975 22.0001C35.8975 31.3889 28.2863 39.0001 18.8975 39.0001C9.50861 39.0001 1.89746 31.3889 1.89746 22.0001C1.89746 12.6112 9.50861 5.00006 18.8975 5.00006C20.882 5.00006 22.7899 5.34068 24.564 5.96773C25.245 6.20841 25.6019 6.95551 25.3611 7.63646C25.1205 8.3174 24.3734 8.67429 23.6925 8.43363C22.1944 7.90413 20.5811 7.61545 18.8975 7.61545Z" fill="#C38E2B"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.8975 14.6001C16.5779 14.6001 14.6975 16.3462 14.6975 18.5001C14.6975 20.654 16.5779 22.4001 18.8975 22.4001C21.217 22.4001 23.0975 20.654 23.0975 18.5001C23.0975 16.3462 21.217 14.6001 18.8975 14.6001ZM11.8975 18.5001C11.8975 14.9102 15.0315 12.0001 18.8975 12.0001C22.7635 12.0001 25.8975 14.9102 25.8975 18.5001C25.8975 22.09 22.7635 25.0001 18.8975 25.0001C15.0315 25.0001 11.8975 22.09 11.8975 18.5001Z" fill="#C38E2B"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.8974 29.5174C14.895 29.5174 11.38 31.4686 9.38678 34.4134C8.98896 35.0011 8.15593 35.1766 7.52612 34.8054C6.89632 34.4342 6.70827 33.6568 7.10607 33.0691C9.57274 29.4249 13.9312 27.0001 18.8974 27.0001C23.8638 27.0001 28.2222 29.4249 30.6889 33.0691C31.0867 33.6568 30.8986 34.4342 30.2688 34.8054C29.639 35.1766 28.806 35.0011 28.4082 34.4134C26.4148 31.4686 22.8999 29.5174 18.8974 29.5174Z" fill="#C38E2B"></path>
                            </svg>
                        </div>
                        <span class="font-bold ml-4 text-color_primary flex-1"  style="
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    ">{{ $customerLogin['text'] }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>


@push('javascript')
<script>
    jQuery(document).ready(function($) {
        $('#main-nav').hcOffcanvasNav({
            disableAt: 1025,
            customToggle: $('.toggle-nav'),
            navTitle: '',
            levelTitles: true,
            levelTitleAsBack: true
        });
    });
</script>
@endpush

