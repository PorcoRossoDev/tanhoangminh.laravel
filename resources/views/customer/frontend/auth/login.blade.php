@extends('homepage.layout.home')
@section('content')


<div class="relative after:content[''] after:bg-[rgba(195,142,43,0.9)] after:absolute after:top-0 after:left-0 after:w-full after:h-full" style="background: url('http://tanhoangminh.laravel/upload/images/logo/bg-contact.png')">
    <div class="container">
        <div class="flex justify-center md:h-[100vh] md:py-0 py-[40px] items-center">
            <div class="xl:w-[1200px] w-full relative z-10">
                <div class="md:flex gap-[30px] bg-white rounded-[30px] mt-[22px] overflow-hidden">
                    <div class="xl:w-[600px] md:w-[45%] w-full">
                        <img src="{{ asset($fcSystem['banner_0']) }}" class="w-full h-full object-cover" alt="">
                    </div>
                    <div class="flex-1 lg:p-[25px] py-[20px] px-[20px]">
                        <div class="flex justify-between">
                            <a href="{{ url('/') }}" class="flex items-center">
                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 7.7373H3.83L9.42 2.1473L8 0.737305L0 8.7373L8 16.7373L9.41 15.3273L3.83 9.7373H16V7.7373Z" fill="#666666"/>
                                </svg>
                                <span class="text-color_primary font-semibold text-f13 ml-3">Quay lại trang chủ</span>
                            </a>
                            <div>
                                <img src="{{ asset($fcSystem['homepage_logo']) }}" class="w-[50px] h-[50px] object-cover" alt="">
                            </div>
                        </div>
                        
                        <form action="{{route('customer.login-store')}}" method="POST" id="form-auth" class="mt-[50px]">
                            <div class="text-center font-medium text-f26 lg:mb-[40px] mb-3">Đăng nhập</div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700-700 px-4 py-3 rounded relative mb-5" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">
                                    {{session('success')}}
                                </span>
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
                                <strong class="font-bold">ERROR!</strong>
                                <span class="block sm:inline">
                                    @foreach ($errors->all() as $error)
                                    {{ $error }}
                                    @endforeach
                                </span>
                            </div>
                            @endif
                            <div class="mb-[20px]">
                                <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[12px] block">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="h-[46px] px-[15px] outline-none rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder="">
                            </div>
                            <div class="mb-[20px]">
                                <label for="" class="text-f14 text-[rgba(102,102,102,1)] mb-[12px] block">Mật khẩu</label>
                                <input type="password" name="password" class="h-[46px] px-[15px] outline-none rounded-[10px] w-full text-[rgba(102,102,102,1)] border border-[rgba(102,102,102,0.35)]" placeholder="">
                            </div>
                            
                            <div class="flex justify-between text-f14 mt-5">
                                <div>Chưa có tài khoản? <a href="{{route('customer.register')}}" class="font-medium text-color_primary">Đăng ký</a></div>
                                <div><a href="" class="underline">Quên mật khẩu</a></div>
                            </div>
                            <button type="submit" class="bg-color_primary text-white text-f16 leading-[100%] rounded-[25px] py-[17px] w-full mt-[30px]">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@include('customer.frontend.auth.common.style')