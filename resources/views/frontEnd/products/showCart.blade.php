@extends('frontEnd.layouts.app')

@section('content')

{{-- FLASH MESSAGE DISPLAY --}}
@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
    
    </div>
@endif
{{-- END FLASH MESSAGE --}}
@if(!$cartItems->isEmpty())
<div class="container">

    <h2>Your Shopping Cart</h2>

    @if(empty($cartItems) || count($cartItems) == 0)
    <p>No items in your cart.</p>
    @else
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        @foreach($cartItems as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['product_name'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ $item['prize'] }}</td>
            <td>{{ $item['quantity'] * $item['prize'] }}</td>
        </tr>
        @endforeach
    </table>
    {{-- pagination --}}
    {{-- <div style="padding: 10px; float:right;">
                {!!
                $cartItems->appends(\Illuminate\Support\Facades\Request::except('page'))->links()
                !!}
            </div> --}}
    {{-- end pagination --}}
    @endif
    <table class="table" >
        <tr>
        <td>
        <a class="btn btn-primary" href="{{ route('index') }}">Continue Shopping</a>
        <a href="{{route('remove_cart',encrypt($item->id))}}" class="btn btn-outline-danger"
            onclick="return confirm('Are you sure to remove this product?')">Remove
            Product
        </a>
        <a class="btn btn-outline-success " href="{{ route('users.pdf') }}">Pdf</a>
        
    </td>
    
        </tr>
    </table>

  
  
   
    

    <div>

        <h1 class="h1_css">Proceed to Order:</h1>
        <div class="d-flex align-items-center justify-content-center">
            <a href="{{route('cash_order')}}" class="btn btn-outline-dark mr-2">Cash On Delivary</a>
            {{-- <form action="{{route('stripePost',$totalPrice )}}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button class="btn btn-outline-success" type="submit" id="">Pay Using Card</button>
            </form> --}}
            {{-- <a href="{{route('charge_stripe',$totalPrice )}}" class="btn btn-outline-success">Pay Using
            Card</a>
            --}}
            <form class="checkout_css" action="{{route('session')}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" class="btn btn-outline-success"
                    id="checkout-live-button">Checkout</button>
            </form>
        </div>


    </div>
</div>
@else

<div class="center">
    <div class="container-fluid  mt-100">
        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <div class="card-header text-center">
                        <h5>Cart</h5>
                    </div>
                    <div class="card-block">
                        <div class="card-logo d-flex justify-content-center mb-3">
                        <i class="bi bi-cart"></i> 
                        </div>
                        <div class="card-area text-center">
                            <div>Your Cart is Empty<br>
                                Add something to make me happy :)</div>
                            <a href="{{ route('index') }}" class="btn btn-primary cart-btn-transform m-3"
                                data-abc="true">continue
                                shopping</a>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>
</div>


@endif

@endsection