@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-12">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
            </div>
            @foreach ($products as $item)
                @php
                    $product = (object)$item;
                @endphp
                <div class="col-3 text-center mb-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ $product->image_url }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">&#2547; {{ $product->price }}</p>
                            <a href="{{ route('details',$product->product_id) }}" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
