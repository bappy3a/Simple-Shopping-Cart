@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-4">
                <img src="{{ $product->image_url }}" class="img-fluid rounded img-thumbnail" alt="{{ $product->title }}">
            </div>
            <div class="col-8">
                <form action="{{ route('addTocart') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->product_id }}">
                    <h3>{{ $product->title }}</h3>
                    <p class="text-justify">{{ $product->description }}</p>
                    <h2>&#2547; {{ $product->price }}</h2>
                    <button type="submit" class="btn btn-primary">Add To Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
