@extends('layouts.app')

@section('content')
<div class="container">
    <div class="h4 card-header justify-content-between">
      <strong>Maintenance</strong>
      <a href="/Fetching">Fetch My Products</a>
      <a href="/">Show All Products</a>
      
      <a href="/registerOwner">Create Owner</a>
      <a href="/CreateProduct">Add Products</a>
    </div>

    @foreach($products as $product)
      <div class="card-body" style="text-align:center;">
      @if ( $product->user_id == Auth()->user()->id)
      <p class="is-size-5 is-italic has-text-weight-semibold">Created By You</p>
      <p>{{ $product->created_at }}</p>
      @else
      <p class="is-size-5 is-italic has-text-weight-semibold">Created By {{ $product->user->name}}</p>
      <p>{{ $product->created_at }}</p>
      @endif
      
      <div class="row">
            
            <div class="col-md-8 img">
            <img src = "{{ $product->img }}">
            </div>
            
            <div class="col-md-4">
            <div class="h5">
              <strong>
              <a href="/{{ $product->id }}">{{ $product->name }}</a></strong>
            </div>

            <div class="b">
              {{ $product->Description }}
            </div>
            
            <div>
            <p><label for="price" class="text-lg-left font-weight-bold">{{ $product->Price }}$</label></p>
            <label for="Quantity" class="font-italic">Quantity:</label>
              {{ $product->Quantity }} 
            </div>

            </div>
            </div>
            </div>
       <div class="hr"></div>
      @endforeach

</div>
@endsection