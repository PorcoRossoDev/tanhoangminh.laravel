@extends('homepage.layout.home')
@section('content')
<main>
    <div class="container my-4">
        @include('customer.frontend.auth.common.navigation')
        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12 lg:col-span-3">
                @include('customer.frontend.auth.common.sidebar')
            </div>
            <div class="col-span-12 lg:col-span-9 bg-white p-3 border-t-[3px] border-[#000]">
                <h1 class="text-black font-bold text-xl hidden">{{trans('index.AccountInformation')}}</h1>
                <div class="relative pb-3">
                    <ul class="ul-tab flex items-center gap-3 pl-0">
                        <li class="py-2 tab-profile active"><a href="javascript:void(0)" onclick="tab('profile')">{{trans('index.AccountInformation')}}</a></li>
                        <li class="py-2 tab-change-password"><a href="javascript:void(0)" onclick="tab('change-password')">{{trans('index.Password')}}</a></li>
                    </ul>
                </div>
                <div id="tab-profile" class="tab-box active">
                    <form id="form-information">
                        @csrf
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2 print-error-msg " style="display: none">
                            <strong class="font-bold">ERROR!</strong>
                            <span class="block sm:inline"></span>
                        </div>
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-2 print-success-msg" style="display: none">
                            <div class="flex items-center mb-">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-bold"></span>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="grid md:grid-cols-12 md:gap-4 gap-1 mb-3">
                                <span class="col-span-12 lg:col-span-3 md:col-span-3 text-f16 mb-1 flex items-center md:justify-end">Email</span>
                                <div class="col-span-12 lg:col-span-9 md:col-span-9">
                                    <input autocomplete="off" disabled="" inputmode="text" type="text" value="{{$detail->email}}" class="w-full border border-gray-300 rounded-md cursor-not-allowed px-3 h-10 bg-gray-200">
                                </div>
                            </div>
                            <div class="grid md:grid-cols-12 md:gap-4 gap-1 mb-3">
                                <span class="col-span-12 lg:col-span-3 md:col-span-3 text-f16 mb-1  flex items-center md:justify-end">{{trans('index.Fullname')}}<span class="text-f13 text-red-600">*</span></span>
                                <div class="col-span-12 lg:col-span-9 md:col-span-9">
                                    <input autocomplete="off" type="text" name="name" value="{{$detail->name}}" class="w-full border border-gray-300 rounded-md px-3 h-10 ">
                                </div>
                            </div>
                            <div class="grid md:grid-cols-12 md:gap-4 gap-1 mb-3">
                                <span class="col-span-12 lg:col-span-3 md:col-span-3 text-f16 mb-1  flex items-center md:justify-end">{{trans('index.Phone')}}<span class="text-f13 text-red-600">*</span></span>
                                <div class="col-span-12 lg:col-span-9 md:col-span-9">
                                    <input autocomplete="off" type="text" name="phone" value="{{$detail->phone}}" class="w-full border border-gray-300 rounded-md px-3 h-10 ">
                                </div>
                            </div>
                            <div class="grid md:grid-cols-12 md:gap-4 gap-1 mb-3">
                                <span class="col-span-12 lg:col-span-3 md:col-span-3 font-bold text-f16 mb-1 flex items-center md:justify-end"></span>
                                <div class="col-span-12 lg:col-span-9 md:col-span-9">
                                    <button class="js_submit_information font-bold h-10 text-white bg-global flex-1 cursor-pointer items-center inline-flex rounded-md px-3 bg-[#000] text-[14px]">
                                        {{trans('index.SaveChanges')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
    
                <div id="tab-change-password" class="tab-box hidden">
                    <form id="form-password">
                        @csrf
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2 print-error-msg " style="display: none">
                            <strong class="font-bold">ERROR!</strong>
                            <span class="block sm:inline"></span>
                        </div>
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-2 print-success-msg" style="display: none">
                            <div class="flex items-center mb-">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-bold"></span>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="grid md:grid-cols-12 md:gap-4 gap-1 mb-3">
                                <span class="col-span-12 lg:col-span-3 md:col-span-3 text-f16 mb-1 flex items-center md:justify-end">{{trans('index.CurrentPassword')}}<span class="text-f13 text-red-600">*</span></span>
                                <div class="col-span-12 lg:col-span-9 md:col-span-9">
                                    <input autocomplete="off" type="password" name="current_password" class="w-full border border-gray-300 rounded-md px-3 h-10">
                                </div>
                            </div>
                            <div class="grid md:grid-cols-12 md:gap-4 gap-1 mb-3">
                                <span class="col-span-12 lg:col-span-3 md:col-span-3 text-f16 mb-1 flex items-center md:justify-end">{{trans('index.ANewPassword')}}<span class="text-f13 text-red-600">*</span></span>
                                <div class="col-span-12 lg:col-span-9 md:col-span-9">
                                    <input autocomplete="off" type="password" name="old_password" class="w-full border border-gray-300 rounded-md px-3 h-10 ">
                                </div>
                            </div>
                            <div class="grid md:grid-cols-12 md:gap-4 gap-1 mb-3">
                                <span class="col-span-12 lg:col-span-3 md:col-span-3 text-f16 mb-1 flex items-center md:justify-end">{{trans('index.ConfirmNewPassword')}}<span class="text-f13 text-red-600">*</span></span>
                                <div class="col-span-12 lg:col-span-9 md:col-span-9">
                                    <input autocomplete="off" type="password" name="new_password" class="w-full border border-gray-300 rounded-md px-3 h-10 ">
                                </div>
                            </div>
                            <div class="grid md:grid-cols-12 md:gap-4 gap-1 mb-3">
                                <span class="col-span-12 lg:col-span-3 md:col-span-3 text-f16 mb-1 flex items-center md:justify-end"></span>
                                <div class="col-span-12 lg:col-span-9 md:col-span-9">
                                    <button class="js_submit_password font-bold h-10 text-white bg-global flex-1 cursor-pointer items-center inline-flex rounded-md px-3 bg-[#000] text-[14px]">
                                        {{trans('index.SaveChanges')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-6">
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
    </div>
</main>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('frontend/css/app.css')}}"/>
@endpush

@push('javascript')
<script>
    function tab(e) {
        $('.ul-tab li').removeClass('active');
        $('.ul-tab li.tab-' + e).removeClass('hidden').addClass('active');
        $('.tab-box').removeClass('active').addClass('hidden');
        $('#tab-' + e).addClass('active').removeClass('hidden');
    }
</script>
<style type="text/css">
    .ul-tab .active {
        color: rgba(0, 101, 238, 1);
        border-bottom: 2px solid rgba(0, 101, 238, 1);
        font-weight: 700
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $(".js_submit_information").click(function(e) {
            e.preventDefault();
            var _token = $("#form-information input[name='_token']").val();
            var name = $("#form-information input[name='name']").val();
            var phone = $("#form-information input[name='phone']").val();
            $.ajax({
                url: "<?php echo route('customer.updateInformation') ?>",
                type: 'POST',
                data: {
                    _token: _token,
                    name: name,
                    phone: phone,
                },
                success: function(data) {
                    if (data.status == 200) {
                        $("#form-information .print-error-msg").css('display', 'none');
                        $("#form-information .print-success-msg").css('display', 'block');
                        $("#form-information .print-success-msg span").html("<?php echo trans('index.InformationSuccess') ?>");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        $("#form-information .print-error-msg").css('display', 'block');
                        $("#form-information .print-success-msg").css('display', 'none');
                        $("#form-information .print-error-msg span").html(data.error);
                    }
                }
            });
        });
    });
    $(document).ready(function() {
        $(".js_submit_password").click(function(e) {
            e.preventDefault();
            var _token = $("#form-password input[name='_token']").val();
            var current_password = $("#form-password input[name='current_password']").val();
            var old_password = $("#form-password input[name='old_password']").val();
            var new_password = $("#form-password input[name='new_password']").val();
            $.ajax({
                url: "<?php echo route('customer.storeChangePassword') ?>",
                type: 'POST',
                data: {
                    _token: _token,
                    current_password: current_password,
                    old_password: old_password,
                    new_password: new_password,
                },
                success: function(data) {
                    if (data.status == 200) {
                        $("#form-password .print-error-msg").css('display', 'none');
                        $("#form-password .print-success-msg").css('display', 'block');
                        $("#form-password .print-success-msg span").html("<?php echo trans('index.PasswordSuccess') ?>");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        $("#form-password .print-error-msg").css('display', 'block');
                        $("#form-password .print-success-msg").css('display', 'none');
                        $("#form-password .print-error-msg span").html(data.error);
                    }
                }
            });
        });
    });
</script>
@endpush