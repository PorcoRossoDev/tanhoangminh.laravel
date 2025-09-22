<?php
$catAside = getAsideCatArticle();
?>

<div class="col-lg-4 col-sm-12 col-xs-12">
    @if (isset($catAside))
        @foreach ($catAside as $k => $item)
            <div class="aside-item wow fadeInUp">
                <div class="block-title">
                    <h2 style="border-bottom: 2px solid #e91e63;">{{ $item->title }}</h2>
                </div>
                <div class="list-box">
                    @foreach ($item->posts as $post)
                        <div class="item flex-module1">
                            <div class="image">
                                <a href="{{ route('routerURL', ['slug' => $post->slug]) }}">
                                    <img src="{{ asset(!empty($post->image) ? $post->image : 'images/404.jpg') }}" alt="{{ $post->title }}">
                                </a>
                            </div>
                            <div class="nav-image">
                                <h3 class="title">
                                    <a href="{{ route('routerURL', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="date ctm-date">{{ date('d/m/Y', strtotime($post->created_at)) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @php
                $imagJson = json_decode($item->image_json, true);
            @endphp
            @if( isset($imagJson) && is_array($imagJson) && count($imagJson) )
                <div class="list-ads wow fadeInUp">
                    @foreach($imagJson as $item)
                    <div class="ads-img" style="padding-bottom: 10px">
                        <a href="javascript:void(0)">
                            <img src="{{ asset($item) }}" alt="">
                        </a>
                    </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    @endif
</div>