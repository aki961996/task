@extends('layouts.app')

@section('content')
<body>
    <h1>Order Invoice</h1>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>

           
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Payment Status</th>
            <th>Delivary Status</th>
            <th>Total Price</th>
            <th>Date</th>
        </tr>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->product_name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->payment_status }}</td>
            <td>{{ $order->delivary_status }}</td>
            
            <td>${{ $order->prize }}</td>

            <td>{{ $order->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
    </table>
</body>
@endsection
