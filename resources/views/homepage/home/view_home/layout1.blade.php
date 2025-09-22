@if( isset($item) && count($item->posts) > 0 )
<div class="home-block-1 wow fadeInUp">
    <div class="block-title">
        <h2 style="border-bottom: 2px solid #66bb6a;">{{ $item->title }}</h2>
    </div>
    <div class="swiper-for-three swiper-container" data-wow-delay="0.4s">
        <div class="swiper-wrapper">
            @foreach( $item->posts as $post )
                <div class="swiper-slide item">
                    <div class="image">
                        <a href="{{ route('routerURL', ['slug' => $post->slug]) }}">
                            <img src="{{ asset(!empty($post->image) ? $post->image : 'images/404.jpg') }}" alt="">
                        </a>
                        <a href="{{ route('routerURL', ['slug' => $post->slug]) }}" class="category category-absolute">{{ $item->title }}</a>
                    </div>
                    <h3 class="title">
                        <a href="{{ route('routerURL', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                    </h3>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif