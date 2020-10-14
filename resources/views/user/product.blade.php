@extends('layouts.user')

@section('content')

    <div class="container p-0">
        <div class="row">
            <div class="col-md-5 pt-4 mt-5">

                <div id="gallery" class="mt-2">

                    @foreach ($product->product_images as $item)

                        @if($loop->first)
                            <img id="largeImage" src="{{ asset('/images/multiple-images/'.$item->path) }}"
                                 class="animate__animated animate__slideInRight "/>
                        @endif
                    @endforeach
                    <div id="thumbs">
                        @foreach ($product->product_images as $item)
                            <img class="animate__animated animate__fadeInRight" id="largeImage"
                                 src="{{ asset('/images/multiple-images/'.$item->path) }}"/>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <product item_id="{{ $product->id }}"></product>
            </div>
        </div>
    </div>

@endsection
