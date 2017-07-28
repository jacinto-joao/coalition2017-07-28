@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Json Dashboard <a href="{{route('product')}}" class="btn btn-danger btn-xs pull-right" data-toggle="ajax-modal">New Product</a></div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Json File</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{number_format($product->price,2)}}</td>
                                <td><a href="{{route('products.download',$product->id)}}"  class="btn btn-primary btn-xs">Download</a></td>
                                <td>
                                    <a href="{{route('products.edit',$product->id)}}" data-toggle="ajax-modal" class="btn btn-primary btn-xs">Edit</a>
                                    <a href="{{route('products.delete',$product->id)}}" class="btn btn-danger btn-xs">Delete</a>
                                </td>
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
