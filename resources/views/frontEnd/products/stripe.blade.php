@extends('frontEnd.layouts.app')

@section('content')

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <!-- @include('home.header') -->
        <!-- end header section -->

        <div class="hero_area">
            <div class="center">
                <form action="{{route('session',$totalPrize)}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-success" id="checkout-live-button">Checkout</button>
                </form>


            </div>
        </div>

        <!-- footer start -->
        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

                Distributed By <a href="" target="_blank">Aki</a>

            </p>
        </div>
        <!-- footer end -->
        <!-- jQery -->
        <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
        <!-- popper js -->
        <script src="{{asset('home/js/popper.min.js')}}"></script>
        <!-- bootstrap js -->
        <script src="{{asset('home/js/bootstrap.js')}}"></script>
        <!-- custom js -->
        <script src="{{asset('home/js/custom.js')}}"></script>
</body>

@endsection