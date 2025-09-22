@extends('homepage.layout.home')
@section('content')


    <div class="relative after:content[''] py-[60px] after:bg-[rgba(195,142,43,0.9)] after:absolute after:top-0 after:left-0 after:w-full after:h-full" style="background: url('upload/images/logo/bg-contact.png')">
        <div class="container">
            <div class="flex justify-center">
                <div class="w-[1255px] relative z-10">
                    <h4 class="text-white text-f20 font-semibold">
                        <a href="{{ url('/') }}" class="flex items-center">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0501 10.9644H5.51762L13.5707 2.9113L11.5251 0.880005L0 12.4051L11.5251 23.9301L13.5563 21.8988L5.51762 13.8457H23.0501V10.9644Z" fill="white"/>
                            </svg>
                            Quay lại trang chủ
                        </a>
                    </h4>
                    <div class="flex gap-[30px] bg-white rounded-[30px] mt-[22px] p-[25px]">
                        <div class="w-[615px]">
                            <img src="upload/images/logo/contact-image.png" alt="">
                            <div class="mt-[135px] text-f20 leading-[28px] text-[#4F4F4F]">
                                Cảm ơn bản đã góp phần xây dựng môi trường Tân Hoàng Minh trở nên tốt đẹp hơn.
                            </div>

                            <div class="mt-[20px]">
                                <svg width="545" height="2" viewBox="0 0 545 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0.820068H545" stroke="url(#paint0_linear_748_2440)"/>
                                    <defs>
                                    <linearGradient id="paint0_linear_748_2440" x1="-nan" y1="-nan" x2="-nan" y2="-nan" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D5D5D5"/>
                                    <stop offset="1" stop-color="#D4D4D4" stop-opacity="0"/>
                                    </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                                
                            <div class="text-f20 leading-[28px] mt-[20px] text-[#4F4F4F]">
                                <h4 class="font-bold text-f14">Liên hệ hỗ trợ</h4>
                                <div class="flex items-center">
                                    <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.0996 0.820068C18.5598 0.820068 18.9329 1.19317 18.9329 1.65341V14.9923C18.9329 15.4494 18.5535 15.8201 18.1064 15.8201H3.09277C2.63631 15.8201 2.26627 15.4494 2.26627 14.9923V14.1534H17.2662V4.40341L10.5996 10.4034L2.26627 2.90341V1.65341C2.26627 1.19317 2.63937 0.820068 3.09961 0.820068H18.0996ZM7.26627 10.8201V12.4868H0.599609V10.8201H7.26627ZM4.76627 6.65341V8.32006H0.599609V6.65341H4.76627ZM16.9045 2.48674H4.29472L10.5996 8.16116L16.9045 2.48674Z" fill="#C38E2B"/>
                                    </svg>
                                    <span class="text-f14 ml-[10px]">thmtalk@thm.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-[40px] font-bold leading-[100%] text-center text-color_primary">THM TALK</h3>
                            <form action="" class="mt-[25px]">
                                <div class="grid grid-cols-2 gap-[20px]">
                                    <div class="col-span-2">
                                        <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[12px] block">Họ và tên</label>
                                        <input type="text" name="fullname" class="h-[46px] rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder="">
                                    </div>
                                    <div class="col-span-1">
                                        <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[8px] block">Email</label>
                                        <input type="text" name="email" class="h-[46px] rounded-[10px] w-[225px] text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder="">
                                    </div>
                                    <div class="col-span-1 flex justify-end">
                                        <div>
                                            <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[8px] block">Số điện thoại</label>
                                            <input type="text" name="email" class="h-[46px] rounded-[10px] w-[225px] text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[8px] block">Phòng ban</label>
                                        <input type="text" name="fullname" class="h-[46px] rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder="">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[8px] block">Loại ý kiến</label>
                                        <input type="text" name="fullname" class="h-[46px] rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder="">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[8px] block">Ý kiến của bạn</label>
                                        <textarea name="" class="h-[130px] rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" id="" cols="30" rows="10"></textarea>
                                    </div>
                                    
                                </div>
                                <div class="text-color_primary text-f12 leading-[16px] flex items-center mt-[25px]">
                                    <svg width="41" height="19" viewBox="0 0 41 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_748_2457)">
                                        <g clip-path="url(#clip1_748_2457)">
                                        <path d="M9 16.7368C4.85786 16.7368 1.5 13.3789 1.5 9.23682C1.5 5.09468 4.85786 1.73682 9 1.73682C13.1421 1.73682 16.5 5.09468 16.5 9.23682C16.5 13.3789 13.1421 16.7368 9 16.7368ZM9 15.2368C12.3137 15.2368 15 12.5505 15 9.23682C15 5.92311 12.3137 3.23682 9 3.23682C5.68629 3.23682 3 5.92311 3 9.23682C3 12.5505 5.68629 15.2368 9 15.2368ZM9.75 8.11182V11.4868H10.5V12.9868H7.5V11.4868H8.25V9.61182H7.5V8.11182H9.75ZM10.125 6.23682C10.125 6.85814 9.6213 7.36182 9 7.36182C8.3787 7.36182 7.875 6.85814 7.875 6.23682C7.875 5.6155 8.3787 5.11182 9 5.11182C9.6213 5.11182 10.125 5.6155 10.125 6.23682Z" fill="#C38E2B"/>
                                        </g>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_748_2457">
                                        <rect width="40.3563" height="18" fill="white" transform="translate(0 0.236816)"/>
                                        </clipPath>
                                        <clipPath id="clip1_748_2457">
                                        <rect width="22" height="18" fill="white" transform="translate(0 0.236816)"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="">Hướng dẫn tải file</span>
                                </div>
                                <div class="border-[rgba(220,223,230,1)] py-[15px] border border-dashed mt-[30px] rounded-md text-color_primary text-f14 flex justify-center items-center">
                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_748_2464)">
                                        <path d="M21 8.4668V21.46C21 22.0169 20.5552 22.4668 20.0066 22.4668H3.9934C3.44495 22.4668 3 22.0228 3 21.475V3.4586C3 2.92211 3.4487 2.4668 4.00221 2.4668H14.9968L21 8.4668ZM19 9.4668H14V4.4668H5V20.4668H19V9.4668ZM8 7.4668H11V9.4668H8V7.4668ZM8 11.4668H16V13.4668H8V11.4668ZM8 15.4668H16V17.4668H8V15.4668Z" fill="#C38E2B"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_748_2464">
                                        <rect width="24" height="24" fill="white" transform="translate(0 0.466797)"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                    <div class="ml-[15px] text-center">
                                        Kéo thả tệp tin của bạn ở đây <br>
                                        hoặc chọn tệp tin.
                                    </div>
                                </div>
                                <button class="bg-color_primary text-white text-f16 leading-[100%] rounded-[25px] py-[17px] w-full mt-[17px]">Đăng ký</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="main" class="sitemap main-contact pb-[50px] hidden">
        {!! htmlBreadcrumb($page->title, []) !!}
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap mx-[-15px] justify-between">
                <div class="w-full px-[15px] wow fadeInUp">
                    <div class="map">
                        {!! $fcSystem['contact_map'] !!}
                    </div>
                </div>
                <div class="w-full px-[15px]">
                    <div class="contact-btottom">
                        <div class="flex flex-wrap mx-[-15px] justify-between">
                            <div class="w-full xl:w-2/3 xl:order-1 px-[15px] mt-[15px] md:mt-0 wow fadeInUp">
                                <div class="">
                                    <h2
                                        class="title-primary uppercase text-green text-f20 md:text-f23  font-bold leading-[30px] md:leading-[40px] relative pb-[5px] mt-8 mb-[20px]">
                                        Liên hệ với chúng tôi
                                    </h2>

                                    <form action="" id="form-submit-contact" class="contact-block py-0">
                                        @csrf

                                        @include('homepage.common.alert')

                                        <div class="flex flex-wrap justify-between -mx-3">
                                            <div class="w-full md:w-1/2 px-3">

                                                <input name="fullname" type="text"
                                                    class="w-full h-[45px] border outline-none px-2 border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white"
                                                    placeholder="Họ và tên" />
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <input name="email" type="text"
                                                    class="w-full h-[45px] border outline-none px-2 border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white"
                                                    placeholder="Email" />
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">

                                                <input name="address" type="text"
                                                    class="w-full h-[45px] border outline-none px-2 border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white"
                                                    placeholder="Địa chỉ" />
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <input name="phone" type="text"
                                                    class="w-full h-[45px] border outline-none px-2 border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white"
                                                    placeholder="Số điện thoại" />
                                            </div>
                                        </div>


                                        <textarea name="message" id="" cols="30" rows="10"
                                            class="w-full h-[120px] border outline-none px-2 border-gray-300 px-3 py-3 bg-white rounded-sm text-f15" placeholder="Nội dung..."></textarea>
                                        <button type="submit"
                                            class="btn border border-color_primary btn-submit-contact h-[45px] hover:text-color_primary mt-2 rounded-[5px] text-f15 text-white transition-all uppercase w-24 write-review__button write-review__button--submit">
                                            <span>Gửi </span>
                                        </button>

                                    </form>
                                </div>

                            </div>
                            <div class="w-full xl:w-1/3 xl:order-2 px-[15px] mb-6  wow fadeInUp">
                                <div class="bg-gray-100 text-black p-[10px] md:p-[25px] h-full mt-8">
                                    <h2
                                        class="title-primary uppercase text-green text-f20 md:text-f23  font-bold leading-[30px] md:leading-[40px] relative pb-[5px] mb-[20px]">
                                        VỀ CHÚNG TÔI
                                    </h2>
                                    <div class="mb-[20px]">
                                        <h4 class=" font-bold mb-[5px] text-f17">
                                            <i class="fa-solid fa-phone text-f14 mr-[5px] text-Orangefc5"></i>
                                            Hotline
                                        </h4>
                                        <p class="">
                                            <a class="text-black" href="tel:{{ $fcSystem['contact_hotline'] }}">{{ $fcSystem['contact_hotline'] }}</a>
                                        </p>
                                    </div>
                                    <div class="mb-[20px]">
                                        <h4 class="text-black font-bold mb-[5px] text-f17">
                                            <i class="fa-solid fa-envelope text-f14 mr-[5px] text-Orangefc5"></i>
                                            Email
                                        </h4>
                                        <p class="">
                                            <a class="text-black" href="mailto:{{ $fcSystem['contact_email'] }}">{{ $fcSystem['contact_email'] }}</a>
                                        </p>
                                    </div>
                                    <div class="mb-[20px]">
                                        <h4 class=" font-bold mb-[5px] text-f17">
                                            <i class="fa-solid fa-location-dot text-f14 mr-[5px] text-Orangefc5"></i>Địa chỉ
                                        </h4>
                                        <p class="">
                                            {{ $fcSystem['contact_address'] }}
                                        </p>
                                    </div>
                                    <div class="border-t border-gray-200 pt-3 mt-3">
                                        <ul class="flex flex-wrap justify-center">
                                            <li class="mr-[10px]">
                                                <a href="{{ $fcSystem['social_facebook'] }}"
                                                    class="w-[35px] h-[35px] leading-[35px] text-center bg-color_primary text-white border border-color_second  hover:text-color_primary inline-block rounded-full mx-[2p transition-all">
                                                    <i class="fa-brands fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="mr-[10px]">
                                                <a href="{{ $fcSystem['social_twitter'] }}"
                                                    class="w-[35px] h-[35px] leading-[35px] text-center bg-color_primary text-white border border-color_primary  hover:text-color_primary inline-block rounded-full mx-[2p transition-all">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="mr-[10px]">
                                                <a href="{{ $fcSystem['social_instagram'] }}"
                                                    class="w-[35px] h-[35px] leading-[35px] text-center bg-color_primary text-white border border-color_primary  hover:text-color_primary inline-block rounded-full mx-[2p transition-all"><i
                                                        class="fa-brands fa-instagram"></i></a>
                                            </li>
                                            <li class="mr-[10px]">
                                                <a href="{{ $fcSystem['social_youtube'] }}"
                                                    class="w-[35px] h-[35px] leading-[35px] text-center bg-color_primary text-white border border-color_primary  hover:text-color_primary inline-block rounded-full mx-[2p transition-all"><i
                                                        class="fa-brands fa-youtube"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('frontend/css/app.css')}}"/>
<style>
    header,
    footer{
        display: none!important;
    }
</style>
@endpush

@push('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-submit-contact").click(function(e) {
                e.preventDefault();
                var _token = $("#form-submit-contact input[name='_token']").val();
                var fullname = $("#form-submit-contact input[name='fullname']").val();
                var address = $("#form-submit-contact input[name='address']").val();
                var email = $("#form-submit-contact input[name='email']").val();
                var phone = $("#form-submit-contact input[name='phone']").val();
                var message = $("#form-submit-contact textarea[name='message']").val();
                $.ajax({
                    url: "<?php echo route('contactFrontend.store'); ?>",
                    type: 'POST',
                    data: {
                        _token: _token,
                        fullname: fullname,
                        address: address,
                        phone: phone,
                        email: email,
                        message: message
                    },
                    success: function(data) {
                        console.log(data.status);
                        if (data.status == 200) {
                            $("#form-submit-contact .print-error-msg").css('display', 'none');
                            $("#form-submit-contact .print-success-msg").css('display',
                            'block');
                            $("#form-submit-contact .print-success-msg span").html(
                                "<?php echo $fcSystem['message_2']; ?>");
                            setTimeout(function() {
                                location.reload();
                            }, 3000);
                        } else {
                            $("#form-submit-contact .print-error-msg").css('display', 'block');
                            $("#form-submit-contact .print-success-msg").css('display', 'none');
                            $("#form-submit-contact .print-error-msg span").html(data.error);
                        }
                    }
                });
            });
        });
    </script>
@endpush
