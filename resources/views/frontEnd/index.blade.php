@extends('frontEnd.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>All Products List</h2>
        </div>
       
    </div>
</div>



<table class="table table-bordered  table-hover">
    <tr>
        <th>No</th>
        <th>Name</th>
        <!-- <th>Details</th> -->
       
        <th width="280px">Action</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $product->name }}</td>
     
       
       
        <td><a class="btn btn-primary btn-sm" href="{{ route('products.orderDetails',encrypt($product->id)) }}"> Show Product Details</a></td>
    </tr>
    @endforeach
</table>

{!! $products->links() !!}


@endsection
