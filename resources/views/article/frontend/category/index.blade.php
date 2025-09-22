@extends('homepage.layout.home')
@section('content')

<main class="page-category-article">
    {!! htmlBreadcrumb($detail->title, $breadcrumb) !!}

    <div class="main-content">
        <div class="container"> 
            <div class="block-title has-background wow fadeInLeft">
                <h2 class="text-uppercase text-center color-second">{{  $detail->title }}</h2>
            </div>
            <div class="news">
                @if( isset($data) && count($data) )
                    <div class="row post-list">
                        @foreach( $data as $k => $article )
                        <div class="col-lg-4 wow fadeInLeft" data-wow-delay="{{ ($k+1)*0.2 }}s">
                            {!! htmlItemPostHome($article) !!}
                        </div>
                        @endforeach
                        <div class="wow fadeInUp">{!! $data->links() !!}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

@endsection