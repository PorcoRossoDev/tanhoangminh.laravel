@extends('homepage.layout.home')
@section('content')

<div class="main-page">
    <div class="container">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-9">
                @if( $data && $data->isNotEmpty() )
                    @foreach ($data as $k => $post)
                        @if($k == 0)
                            <div class="flex">
                                
                            </div>
                        @else
                            <div>
                            
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="col-span-3">

            </div>
        </div>
    </div>
</div>


@endsection