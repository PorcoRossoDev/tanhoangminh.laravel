@extends('homepage.layout.home')
@section('content')

    @php
        $image = showField($page->fields, 'config_colums_input_contact_icon');
        $ykien = explode(PHP_EOL, showField($page->fields, 'config_colums_textarea_contact_ykien'));
        $phongban = explode(PHP_EOL, showField($page->fields, 'config_colums_textarea_contact_phongban'));
    @endphp
    <div class="relative after:content[''] py-[60px] after:bg-[rgba(195,142,43,0.9)] after:absolute after:top-0 after:left-0 after:w-full after:h-full" style="background: url('upload/images/logo/bg-contact.png')">
        <div class="container">
            <div class="xl:flex justify-center">
                <div class="xl:w-[1255px] relative z-10">
                    <h4 class="text-white text-f20 font-semibold">
                        <a href="{{ url('/') }}" class="flex items-center">
                            <img src="{{ asset('frontend/images/contact-arrow-left.svg') }}" class="h-[23px] w-[23px] mr-3" alt="">
                            Quay lại trang chủ
                        </a>
                    </h4>
                    <div class="xl:flex gap-[30px] bg-white rounded-[30px] mt-[22px] p-[25px]">
                        <div class="xl:w-[615px] w-full">
                            <div class=" xl:text-left text-center">
                                <img src="{{ asset($image) }}" class="xl:h-auto lg:h-[285px] object-contain inline-block" alt="">
                                <div class="xl:mt-[135px] mt-8 xl:text-f20 text-f18 leading-[28px] text-[#4F4F4F]">
                                    {!! $page->description !!}
                                </div>
                            </div>

                            <div class="mt-[20px] h-[1px] w-ful bg-[#D5D5D5]"></div>
                                
                            <div class="text-f20 leading-[28px] mt-[20px] text-[#4F4F4F]">
                                <h4 class="font-bold text-f14">Liên hệ hỗ trợ</h4>
                                <div class="flex items-center">
                                    <img src="{{ asset('frontend/images/contact-email.svg') }}" class="h-[18px] w-[18px]" alt="">
                                    <span class="text-f14 ml-[10px]">{{ $fcSystem['contact_email'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="lg:text-[40px] text-f30 font-bold leading-[100%] text-center text-color_primary lg:mt-0 mt-8">{{ $page->title }}</h3>
                            <form action="" id="form-submit-contact" class="mt-[25px]">
                                @csrf
                                @include('homepage.common.alert')
                                <div class="grid grid-cols-2 gap-[20px]">
                                    <div class="col-span-2">
                                        <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[12px] block">Họ và tên</label>
                                        <input type="text" name="fullname" class="text-f14 outline-none px-3 h-[46px] rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder="">
                                    </div>
                                    <div class="xl:col-span-1 col-span-2">
                                        <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[8px] block">Email</label>
                                        <input type="text" name="email" class="text-f14 outline-none px-3 h-[46px] rounded-[10px] xl:w-[225px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder="">
                                    </div>
                                    <div class="xl:col-span-1 col-span-2 xl:flex justify-end">
                                        <div>
                                            <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[8px] block">Số điện thoại</label>
                                            <input type="text" name="phone" class="text-f14 outline-none px-3 h-[46px] rounded-[10px] xl:w-[225px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[8px] block">Phòng ban</label>
                                        <select name="phongban" id="" class="text-f14 outline-none px-3 h-[46px] rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]">
                                            @if(isset($phongban) && is_array($phongban) && count($phongban))
                                                @foreach ($phongban as $val)
                                                    <option value="{{ $val }}">{{ $val }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <!-- <input type="text" name="fullname" class="hidden outline-none px-3 h-[46px] rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder=""> -->
                                    </div>
                                    <div class="col-span-2">
                                        <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[8px] block">Loại ý kiến</label>
                                        <select name="ykien" id="" class="text-f14 outline-none px-3 h-[46px] rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]">
                                            @if(isset($ykien) && is_array($ykien) && count($ykien))
                                                @foreach ($ykien as $val)
                                                    <option value="{{ $val }}">{{ $val }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <!-- <input type="text" name="fullname" class="hidden outline-none px-3 h-[46px] rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder=""> -->
                                    </div>
                                    <div class="col-span-2">
                                        <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[8px] block">Ý kiến của bạn</label>
                                        <textarea name="message" class="text-f14 outline-none px-3 py-3 h-[130px] rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" id="" cols="30" rows="10"></textarea>
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
                                <button type="button" id="openFile" class="border-[rgba(220,223,230,1)] py-[15px] outline-none border border-dashed mt-[30px] w-full rounded-md text-color_primary text-f14 flex justify-center items-center">
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
                                    <div class="ml-[15px] text-center" id="fileName">
                                        Kéo thả tệp tin của bạn ở đây <br>
                                        hoặc chọn tệp tin.
                                    </div>
                                </button>
                                <input type="file" id="fileItem" name="file" class="hidden">
                                <button type="submit" class="bg-color_primary text-white text-f16 leading-[100%] rounded-[25px] py-[17px] w-full mt-[17px]">Đăng ký</button>
                            </form>
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


    <script>
        $(document).ready(function(){

            var textFileDefault = 'Kéo thả tệp tin của bạn ở đây <br> hoặc chọn tệp tin.'
            $("#openFile").on("click", function(){
                $("#fileItem").click();
            });

            $("#fileItem").on("change", function(){
                if(this.files.length > 0){
                    let fileName = this.files[0].name;
                    $("#openFile .ml-[15px]").html("Đã chọn: " + fileName);
                    $('#fileName').html(fileName)
                }
            });


            $("#form-submit-contact").on("submit", function(e){
                e.preventDefault();

                let form = $(this)[0];
                let formData = new FormData(form);

                formData.append("_token", $("input[name=_token]").val());
                formData.append("fullname", $("input[name=fullname]").val());
                formData.append("email", $("input[name=email]").val());
                formData.append("phone", $("input[name=phone]").val());
                formData.append("phongban", $("select[name=phongban]").val());
                formData.append("ykien", $("select[name=ykien]").val());
                formData.append("message", $("textarea[name=message]").val());

                // kiểm tra file
                let fileInput = $("#fileItem")[0];
                if(fileInput.files.length > 0){
                    let file = fileInput.files[0];
                    if(file.size > 2 * 1024 * 1024){ // 2MB
                        alert("Dung lượng file tối đa 2MB!");
                        return false;
                    }
                    formData.append("file", file);
                }

                $.ajax({
                    url: "<?php echo route('contactFrontend.store'); ?>", // thay bằng route xử lý form
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        // loading nếu muốn
                    },
                    success: function(data){
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
                        $("#form-submit-contact")[0].reset();
                    },
                    error: function(xhr){
                        //alert("Có lỗi xảy ra, vui lòng thử lại.");
                        console.log(xhr.responseText);
                    }
                });
            });

        });
    </script>

    <!-- <script type="text/javascript">
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
                    url: "<?php //echo route('contactFrontend.store'); ?>",
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
    </script> -->
@endpush
