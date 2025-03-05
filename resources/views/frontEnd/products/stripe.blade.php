@extends('frontEnd.layouts.app')

@section('content')

<body>
    <div class="hero_area">
        

        <div class="hero_area">
            <div class="center">
                <form action="{{route('session',$totalPrize)}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-success" id="checkout-live-button">Checkout</button>
                </form>


            </div>
        </div>

      
</body>

@endsection