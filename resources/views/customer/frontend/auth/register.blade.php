@extends('homepage.layout.home')
@section('content')

<main class="py-8">
    <div class="container">
        <div class="wrap-dangnhap">
            <div class="wp-dangnhap">
                <div class="logo">
                    <img src="{{ asset($fcSystem['homepage_logo']) }}" alt="">
                </div>
                <div class="desc" style="text-align: center;color: #555">
                    <h3 style="color: #fff;font-size: 15px;margin-bottom: 30px;">登入</h3>
                </div>
                <form action="{{route('customer.register-store')}}" method="POST" id="form-auth">
                    @csrf
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissable mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <b>Success!</b> {{session('success')}}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
                        <strong class="font-bold">ERROR!</strong>
                        <span class="block sm:inline">
                            @foreach ($errors->all() as $error)
                            {{ $error }}
                            @endforeach
                        </span>
                    </div>
                    @endif
                    <div class="">
                        <input type="text" class="" name="name" aria-describedby="emailHelp" placeholder="姓名" value="{{old('name')}}">
                    </div>
                    <div class="">
                        <input type="text" class="" name="email" aria-describedby="emailHelp" placeholder="Email" value="{{old('email')}}">
                    </div>
                    <div class="">
                        <input type="password" class="" name="password" aria-describedby="emailHelp" placeholder="電話號碼">
                    </div>
                    <div class="">
                        <input type="password" class="" name="confirm_password" aria-describedby="" placeholder="密碼">
                    </div>
                    <div class="">
                        <button type="submit" class="">註冊</button>
                    </div>
                    <div class="mt-4">
                        <p class="" style="font-size: 13px">
                            <a href="{{route('customer.login')}}" class="text-white underline">登录！</a>
                        </p>
                    </div>
                </form>

            </div>

        </div>

    </div>
</main>
@endsection

<!-- @push('css')
<style>
    main {
        width: 100%;
        min-height: 100vh;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding: 15px;
        background: url(https://ezdaily.tamphat.edu.vn/uploads110821/images/homepage/pexels-photo-694740.jpeg);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }
    .wp-dangnhap {
        width: 680px;
        background: #303030;
        border-radius: 10px;
        position: relative;
        display: inline-block;
        color: #fff;
        padding-inline: 110px;
        padding-block: 20px;
    }
    .wrap-dangnhap {
        display: flex;
        justify-content: center;
    }
    .wp-dangnhap input {
        color: #fff;
        line-height: 1.2;
        font-size: 15px;
        display: block;
        width: 100%;
        background: transparent;
        height: 40px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 0 15px;
        margin-top: 20px;
    }

    .wp-dangnhap button:before {
        content: "";
        display: block;
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
        border-radius: 5px;
        top: 0;
        left: 0;
        background: #a64bf4;
        background: -webkit-linear-gradient(45deg, #00dbde, #fc00ff);
        background: -o-linear-gradient(45deg, #00dbde, #fc00ff);
        background: -moz-linear-gradient(45deg, #00dbde, #fc00ff);
        background: linear-gradient(45deg, #00dbde, #fc00ff);
        opacity: 0;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        transition: all 0.4s;
    }

    .wp-dangnhap button {
        position: relative;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 20px;
        width: 100%;
        height: 48px;
        background-color: #38aae6;
        border-radius: 5px;
        font-size: 18px;
        color: #fff;
        line-height: 1.2;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        transition: all 0.4s;
        position: relative;
        z-index: 1;
        border: none;
        margin-top: 20px;
    }
    @media (max-width: 767px){
        .wp-dangnhap {
            width: 100%;
            padding-inline: 25px;
            padding-block: 20px;
        }
        .wp-dangnhap .logo img {
            height: 110px;
            display: inline-block;
        }
        .wp-dangnhap .logo {
            text-align: center;
        }
    }
    .wp-dangnhap button:hover:before {
        opacity: 1;
    }
</style>
@endpush -->

@include('customer.frontend.auth.common.style')