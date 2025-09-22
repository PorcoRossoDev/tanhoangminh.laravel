@push('css')
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
        background: url({{ asset('frontend/images/pexels-photo-694740.jpeg') }});
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

    .wp-dangnhap button:hover:before {
        opacity: 1;
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
</style>
@endpush