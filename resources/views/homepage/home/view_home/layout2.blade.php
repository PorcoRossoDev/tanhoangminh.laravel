@if( isset($item) && count($item->posts) > 0 )
<div class="home-block-2 wow fadeInUp">
    <div class="block-title">
        <h2 style="border-bottom: 2px solid #7f8fa9;">{{ $item->title }}</h2>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="left-box">
                @foreach( $item->posts as $key => $post )
                    @if( $key == 0 )
                        <div class="item">
                            <div class="image">
                                <a href="{{ route('routerURL', ['slug' => $post->slug]) }}">
                                    <img src="{{ asset(!empty($post->image) ? $post->image : 'images/404.jpg') }}"
                                        alt="{{ $post->title }}">
                                    </a>
                                <a href="{{ route('routerURL', ['slug' => $item->slug]) }}" class="category category-absolute">{{ $item->title }}</a>
                            </div>
                            <h3 class="title section-title">
                                <a href="{{ route('routerURL', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="date ctm-date">{{ date('d/m/Y', strtotime($post->created_at)) }}</p>
                            <div class="desc">{!! $post->description !!}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="right-box">
                @foreach( $item->posts as $key => $post )
                    @if( $key > 0 && $key < 6 )
                        <div class="item flex-module1">
                            <div class="image">
                                <a href="10-6-g5885.html">
                                    <img src="{{ asset(!empty($post->image) ? $post->image : 'images/404.jpg') }}"
                                        alt="{{ $post->title }}">
                                </a>
                            </div>
                            <div class="nav-image">
                                <h3 class="title">
                                    <a href="{{ route('routerURL', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="date ctm-date">{{ date('d/m/Y', strtotime($post->created_at)) }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif