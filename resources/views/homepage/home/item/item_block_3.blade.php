<div class="hover-img relative after:content[''] after:bg-[linear-gradient(0deg,#222222_9%,rgba(34,34,34,0.169326)_39.18%,rgba(34,34,34,0.73)_100.01%)] after:absolute after:w-full after:h-full after:top-0 after:left-0">
    <img src="{{ asset(!empty($post->image) ? $post->image : 'images/404.jpg') }}" class="@if($k==0 || $k == 1) 3xl:h-[420px] 2xl:h-[285px] xl:h-[300px] @else 3xl:h-[330px] 2xl:h-[225px] xl:h-[280px] @endif md:h-[390px] h-[280px] w-full object-cover object-bottom" alt="">
</div>
<ul class="absolute inline-flex left-[22px] z-10 top-[27px]">
    <li class="border py-[3px] px-[12px] 3xl:text-f16 2xl:text-f11 text-f12 text-white rounded-[100px] hover:bg-white hover:text-color_primary duration-300"><a href="{{ route('routerURL', ['slug' => $cat_slug]) }}">{{$cat_title}}</a></li>
</ul>
<div class="absolute bottom-5 z-10 w-full text-white px-[22px]">
    <div class="3xl:text-f16 2xl:text-f11 text-f12 mb-2">{{ formatDateVietnamese($post->created_at) }}</div>
    <h4 class="3xl:text-f30 2xl:text-f19 text-f20 font-semibold" style="
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        display: -webkit-box;
    ">
        <a href="{{ route('routerURL', ['slug' => $post->slug]) }}">
            {{$post->title}}
        </a>
    </h4>
</div>