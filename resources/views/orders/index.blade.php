@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Orders</h2>
        </div>
     
    </div>
</div>

@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }}
    </div>
@endsession


<table class="table table-bordered">
                        <tr>
                            <th class="th_des">Name</th>
                          
                            <th class="th_des">Product Name</th>
                          
                           
                            <th class="th_des">Quantity</th>
                            <th class="th_des">Price</th>
                            <th class="th_des">Total Price</th>
                            <th class="th_des">Payment Status</th>
                            <th class="th_des">Delivery Status</th>
                         
                            <th class="th_des">Delivered</th>
                            <!-- <th class="th_des">Print Pdf</th> -->
                           

                        </tr>
                        @forelse($order as $orders)
                        <tr>
                            <td>{{$orders->name}}</td>
                         
                            <td>{{$orders->product_name}}</td>
                           
                            <td>{{$orders->quantity}}</td>
                            <td>&#8377;{{$orders->prize}}</td>
                            <td>&#8377;{{ $orders->prize * $orders->quantity }}</td>
                            <td>{{$orders->payment_status}}</td>
                            <td>{{$orders->delivary_status}}</td>
                        
                            <td>
                                @if($orders->delivary_status == 'processing')
                                <a href="{{ route('delivered', encrypt($orders->id)) }}"
                                    onclick="return confirm('Are you sure this product delivered!!!!')"
                                    class="btn btn-primary small">Delivered</a>
                                @else
                                <p style="color: green">Product is Delivered</p>
                                @endif
                            </td>
                           
                          

                        </tr>
                        @empty
                        <tr>
                            <td colspan="15">
                                No Data Found.
                            </td>
                        </tr>

                        @endforelse
                    </table>

{!! $order->links() !!}


@endsection
