@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your Order list') }}</div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Shiping Info</th>
                            <th scope="col">Product Info</th>
                            <th scope="col">Total Price</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <th scope="row">{{ $order->id }}</th>
                                    <th scope="row">
                                        <dt>Name</dt>
                                        <dd>- {{ $order->name }}</dd>
                                        <dt>Phone</dt>
                                        <dd>- {{ $order->phone }}</dd>
                                        <dt>Address</dt>
                                        <dd>- {{ $order->address }}</dd>
                                    </th>
                                    <th scope="row">
                                    @foreach ($order->orderDetails as $item)
                                        <a href="">
                                            <dt>Name - price</dt>
                                            <dd>- {{ json_decode($item->product)->name }} - (&#2547; {{ json_decode($item->product)->price }})</dd>
                                        </a>
                                    @endforeach
                                    </th>
                                    <th scope="row">&#2547; {{ $order->price }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
