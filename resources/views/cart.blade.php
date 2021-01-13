@extends('layouts.app')

@section('content')
@foreach($carts as $cart)
<table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
       
        <tbody>
        <tr>
            <td data-th="Product">
                <div class="row">
                    <div class="col-sm-3 hidden-xs"><img src="{{ $cart->product->img }}" alt="..." class="img-responsive"/></div>
                    <div class="col-sm-9" >
                        <h4 class="nomargin">{{ $cart->product->name }}</h4>
                        <p>
                            {{ $cart->product->Description }}
                        </p>
                        </div>
                </div>
            </td>
            <td data-th="Price">{{ $cart->product->Price }}$</td>
            <td data-th="Quantity">
                <input type="number" class="form-control text-center" value="{{$cart->Qty}}">
            </td>
            <td data-th="Subtotal" class="text-center">{{ $cart->Price }}$</td>
            <td class="actions" data-th="">
                <button class="btn btn-info btn-sm"><i class="fa fa-refresh" ></i></button>
                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Total {{ $cart->Price }}$</strong></td>
        </tr>
    
        @endforeach
        <tr>
            <td><a href="/" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>

            <form method="POST" action="/cart/{{ Auth()->user()->email }}/{{ Auth()->user()->id }}">
            @csrf
            <button type="submit" class="btn btn-danger"><i></i> Purchase</button></td>
            </form>

        <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total $Total_Sum</strong></td>
        </tr>
        </tfoot>
        
    </table>
 


@endsection