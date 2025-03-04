@extends('frontEnd.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Order Details</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="  col-12 p-3">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <th>Details</th>
                <td>{{ $product->detail }}</td>
            </tr>
            <tr>
                <th>Availble quantity </th>
                <td>{{ $product->quantity }}</td>
            </tr>
            <tr>
                <th>Amount</th>
                <td>{{ $product->prize }}</td>
            </tr>
            <!-- <tr>
        <th>Created at</th>
        <td>{{ $product->created_at }}</td>
    </tr> -->
        </table>

    </div>

    <div class="col-12 p-3">
        <form action="{{route('add_cart',encrypt($product->id))}}" method="Post">
            @csrf
            <div class="row mx-0 align-items-center justify-content-end">
                <div class="col-auto">
                    <input type="number" name="quantity" value="1" min="1" style="width:100px" />

                </div>
                <div class="col-md-4 pl-0">
                    
                <input class="w-100 btn btn-info hide_cart" type="submit" value="Add To Cart" style="padding: 12px 5px" />
               

                </div>

            </div>
        </form>
        
       
    </div>
    <div class="col-12">
    <div class="row mx-0 align-items-center justify-content-end">
        <div class="col-4">
            <a href="{{ route('show_cart') }}" class="w-100 btn btn-success" style="padding: 12px 5px">Show Cart</a>
        </div>
    </div>
</div>



    
</div>



@endsection