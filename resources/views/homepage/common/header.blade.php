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

<header id="header" class="site-header bg-white">
    <div class="4xl:px-[200px] 4xl:py-[20px] 3xl:py-[5px]" id="header-top">
        <div class="flex justify-between">
            <div class="flex items-center">
                <img src="/upload/images/logo/logo-thm.png" class="h-[120px] w-auto" alt="">
                <h3 class="4xl:ml-[120px] text-[#6a0f11] 4xl:text-f31 3xl:text-f19 xl:text-f14">Cổng thông tin nội bộ của <b>Tập đoàn Tân Hoàng Minh</b></h3>
            </div>
            <div class="flex items-center">
                <form action="" id="headerLogin">
                    @csrf
                    <div class="flex gap-[20px] 4xl:text-f20 3xl:text-f13 text-f14">
                        <div>
                            <div class="flex">
                                <span class="bg-[#999999] 4xl:w-[55px] 4xl:h-[55px] xl:w-[35px] xl:h-[35px] round-[5px] flex justify-center items-center">
                                    <svg class="4xl:w-[35px] 4xl:h-[35px] xl:w-[28px] xl:h-[28px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="10" r="3" stroke="#222222" stroke-linecap="round"></circle> <circle cx="12" cy="12" r="9" stroke="#222222"></circle> <path d="M18 18.7059C17.6461 17.6427 16.8662 16.7033 15.7814 16.0332C14.6966 15.3632 13.3674 15 12 15C10.6326 15 9.30341 15.3632 8.21858 16.0332C7.13375 16.7033 6.35391 17.6427 6 18.7059" stroke="#222222" stroke-linecap="round"></path> </g></svg>
                                </span>
                                <input type="text" name="email" class="4xl:h-[55px] xl:h-[35px] 4xl:w-[225px] xl:w-[150px] h-[45px] w-[205px] border round-[5px] border-[#e5e5e5] text-[#969696] outline-none px-2" placeholder="User Name">
                            </div>
                            <div class="inline-flex items-center mt-4">
                                <input type="checkbox" name="remember" class="border-gray-300 rounded checked:bg-color_primary h-4 w-4 mr-2" id="login_remember"> <label for="login_remember">Ghi nhớ tài khoản</label>
                            </div>
                        </div>
                        <div>
                            <div class="flex">
                                <span class="bg-[#999999] 4xl:w-[55px] 4xl:h-[55px] xl:w-[35px] xl:h-[35px] round-[5px] flex justify-center items-center">
                                    <svg class="4xl:w-[35px] 4xl:h-[35px] xl:w-[28px] xl:h-[28px]" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="icomoon-ignore"> </g> <path d="M16 3.205c-7.067 0-12.795 5.728-12.795 12.795s5.728 12.795 12.795 12.795 12.795-5.728 12.795-12.795c0-7.067-5.728-12.795-12.795-12.795zM16 4.271c6.467 0 11.729 5.261 11.729 11.729 0 2.845-1.019 5.457-2.711 7.49-1.169-0.488-3.93-1.446-5.638-1.951-0.146-0.046-0.169-0.053-0.169-0.66 0-0.501 0.206-1.005 0.407-1.432 0.218-0.464 0.476-1.244 0.569-1.944 0.259-0.301 0.612-0.895 0.839-2.026 0.199-0.997 0.106-1.36-0.026-1.7-0.014-0.036-0.028-0.071-0.039-0.107-0.050-0.234 0.019-1.448 0.189-2.391 0.118-0.647-0.030-2.022-0.921-3.159-0.562-0.719-1.638-1.601-3.603-1.724l-1.078 0.001c-1.932 0.122-3.008 1.004-3.57 1.723-0.89 1.137-1.038 2.513-0.92 3.159 0.172 0.943 0.239 2.157 0.191 2.387-0.010 0.040-0.025 0.075-0.040 0.111-0.131 0.341-0.225 0.703-0.025 1.7 0.226 1.131 0.579 1.725 0.839 2.026 0.092 0.7 0.35 1.48 0.569 1.944 0.159 0.339 0.234 0.801 0.234 1.454 0 0.607-0.023 0.614-0.159 0.657-1.767 0.522-4.579 1.538-5.628 1.997-1.725-2.042-2.768-4.679-2.768-7.555 0-6.467 5.261-11.729 11.729-11.729zM7.811 24.386c1.201-0.49 3.594-1.344 5.167-1.808 0.914-0.288 0.914-1.058 0.914-1.677 0-0.513-0.035-1.269-0.335-1.908-0.206-0.438-0.442-1.189-0.494-1.776-0.011-0.137-0.076-0.265-0.18-0.355-0.151-0.132-0.458-0.616-0.654-1.593-0.155-0.773-0.089-0.942-0.026-1.106 0.027-0.070 0.053-0.139 0.074-0.216 0.128-0.468-0.015-2.005-0.17-2.858-0.068-0.371 0.018-1.424 0.711-2.311 0.622-0.795 1.563-1.238 2.764-1.315l1.011-0.001c1.233 0.078 2.174 0.521 2.797 1.316 0.694 0.887 0.778 1.94 0.71 2.312-0.154 0.852-0.298 2.39-0.17 2.857 0.022 0.078 0.047 0.147 0.074 0.217 0.064 0.163 0.129 0.333-0.025 1.106-0.196 0.977-0.504 1.461-0.655 1.593-0.103 0.091-0.168 0.218-0.18 0.355-0.051 0.588-0.286 1.338-0.492 1.776-0.236 0.502-0.508 1.171-0.508 1.886 0 0.619 0 1.389 0.924 1.68 1.505 0.445 3.91 1.271 5.18 1.77-2.121 2.1-5.035 3.4-8.248 3.4-3.183 0-6.073-1.277-8.188-3.342z" fill="#ffffff"> </path> </g></svg>                                
                                </span>
                                <input type="password" name="password" class="4xl:h-[55px] xl:h-[35px] 4xl:w-[225px] xl:w-[150px] h-[45px] w-[205px] border round-[5px] border-[#e5e5e5] text-[#969696] outline-none px-2" placeholder="Mật khẩu">
                            </div>
                            <a href="" class="text-[#2f51ad] inline-block mt-4">Đổi mật khẩu</a>
                        </div>
                        <div>
                            <button type="submit" class="4xl:px-[100px] 4xl:h-[55px] xl:px-[25px] xl:h-[35px] h-[55px] rounded-[5px] bg-[#999999] text-white flex justify-center items-center text-22 uppercase">Đăng nhập</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="main-menu hidden">
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
    <div>
        <img src="upload/images/logo/Anh CBNV 30-4_ 4.jpg" class="4xl:h-[690px] 3xl:h-[500px] xl:h-[450px] w-full object-cover" alt="">
    </div>
    <div class="bg-[#bf8d35] 4xl:py-[10px] xl:py-[5px]">
        <div class="container">
            <div class="">
                <ul class="flex text-white 4xl:text-f32 xl:text-f18 text-f22 justify-between items-center">
                    <li>
                        <a href="">
                            <img src="upload/images/logo/logo-menu.png" class="4xl:h-[60px] xl:h-[45px] w-auto" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="">Về chúng ta</a>
                    </li>
                    <li>
                        <a href="">Bất động sản</a>
                    </li>
                    <li>
                        <a href="">Trách nhiệm xã hội</a>
                    </li>
                    <li>
                        <a href="">THM 360</a>
                    </li>
                    <li>
                        <a href="">THM Talk</a>
                    </li>
                    <li>
                        <a href="">Multimedia</a>
                    </li>
                    <li>
                        <a href=""><img src="{{ asset('frontend/images/search.png') }}" class="4xl:h-auto 3xl:h-[25px] xl:h-[20px]" alt=""></a>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
    
</header>

<button command="show-modal" id="openError" commandfor="dialog" class="rounded-md bg-gray-950/5 px-2.5 py-1.5 text-sm font-semibold text-gray-900 hover:bg-gray-950/10 hidden">Open dialog</button>
<el-dialog>
  <dialog id="dialog" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
    <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

    <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
      <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          

          <div class="flex">
            <div class="w-[50px]">
                <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-red-600">
                    <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                </div>
            </div>
            <div class="flex-1">
                <div class="">
                
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Lỗi!</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500 loginMessage">Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.</p>
                </div>
                </div>

                <div class="">
                <button type="button" command="close" commandfor="dialog" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Đóng</button>
                </div>
            </div>
            </div>
        </div>
        </div>
        
      </el-dialog-panel>
    </div>
  </dialog>
</el-dialog>



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

<script>
    $(document).ready(function() {
        $("#headerLogin").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo route('customer.login-ajax'); ?>",
                type: 'POST',
                data: $(this).serialize(),
                success: function(res) {
                    if (res.status) {
                        // login thành công
                        alert(res.message);
                        //window.location.href = res.redirect;
                    } else {
                        $('#openError').click()
                        $('.loginMessage').html(res.message)
                    }
                },
                 error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, val) {
                            $('#error-' + key).text(val[0]); 
                        });
                    }
                }
            });
        });
    });
</script>
@endpush

