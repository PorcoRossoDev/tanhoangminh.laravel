@extends('homepage.layout.home')
@section('content')
<div class="main">
    @include('product.frontend.category.data',['module' => $module,'title' => $detail->title])
</div>
@endsection