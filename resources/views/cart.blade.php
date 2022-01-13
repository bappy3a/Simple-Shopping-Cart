@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your Cart') }}</div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if (Session::has('cart'))
                                @foreach (Session::get('cart') as $key => $cartItem)
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td><img width="60px" height="60px" src="{{ $cartItem['image'] }}" alt="" class="rounded"></td>
                                        <td>{{ $cartItem['name'] }}</td>
                                        <td>{{ $cartItem['price'] }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="4"><h3>You have no items in your shopping cart</h3></td>
                            @endif
                        </tbody>
                        <tfoot>
                            @if (Session::has('cart'))
                            <tr >
                                <td colspan="4"><a href="{{ route('checkout') }}" class="btn btn-info">Checkout</a></td>
                            </tr>
                            @endif
                        </tfoot>
                      </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
