@extends('frontEnd.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>All Products List</h2>
        </div>
        <!-- <div class="pull-right">
            @can('product-create')
            <a class="btn btn-success btn-sm mb-2" href="{{ route('products.create') }}"> Create New Product</a>
            @endcan
        </div> -->
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
     
       
        <!-- <td>
            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('products.show',$product->id) }}"> Show</a>
                @can('product-edit')
                <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}"> Edit</a>
                @endcan

                @csrf
                @method('DELETE')

                @can('product-delete')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                @endcan
            </form>
        </td> -->
        <td><a class="btn btn-primary btn-sm" href="{{ route('products.orderDetails',encrypt($product->id)) }}"> Show Product Details</a></td>
    </tr>
    @endforeach
</table>

{!! $products->links() !!}


@endsection
