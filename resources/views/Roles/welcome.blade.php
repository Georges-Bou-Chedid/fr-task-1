@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="h4 card-header justify-content-between">
      <strong>Maintenance</strong>
      @if(Auth()->user())
      <a href="/home/cart" class="btn btn-primary is-size-5">Go To Cart</a>
      @endif
    </div>

    @foreach($products as $product)
      <div class="card-body" style="text-align:center;">
            <div class="row">
            
            <div class="col-md-8 img">
            <img src = "{{ $product->img }}">
            </div>
            
            <div class="col-md-4">
            <div class="h5">
              <strong>
              <a href="/home/{{ $product->id }}">{{ $product->name }}</a></strong>
            </div>

            <div class="b">
              {{ $product->Description }}
            </div>

            @if(Auth()->user())
            <a href="/home/add-to-cart/{{ $product->id }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a>

            @else
            <a href="/home/add-to-cart/{{ $product->id }}" class="btn-secondary btn-block text-center" role="button">Add to cart</a>
            @endif
            
            <div>
            <p><label for="price" class="text-lg-left font-weight-bold">{{ $product->Price }}$</label></p>
            <label for="Quantity" class="font-italic">Quantity:</label>
              {{ $product->Quantity }}
</div>
            @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
            @endif
           
            </div>
            </div>
            <div class="hr"></div>
      @endforeach
            
</div>
 
@endsection