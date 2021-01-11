@extends('layouts.app')

@section('content')

<div class="container">
    <div class="h4 card-header">
      <strong>Maintenance</strong>
    </div>

    <a href="javascript:history.back()" class="btn btn-primary">Back</a>
    
      <div class="card-body" style="text-align:center;">
      

            <div class="row">
            
            <div class="col-md-8 img">
            
            <img src = "{{ $products->img }}">
            </div>
            
            <div class="col-md-4">
            <div class="h5">
              <strong>{{ $products->name }}</strong>
            </div>

            <div class="b">
              {{ $products->Description }}
            </div>

            <div>
            <p><label for="price" class="text-lg-left font-weight-bold">{{ $products->Price }}$</label></p>
            <label for="Quantity" class="font-italic">Quantity:</label>
              {{ $products->Quantity }}
            </div>

            @auth
            @if ( Auth()->user()->role == 'Admin' || Auth()->user()->role == 'Owner')
            <div>
              <form method="GET" action="/home/{{ $products->id }}/edit" >
            <button class="button" type="submit" style="margin-bottom:6px;">Update</button>
            </form>

            <form method="POST" action="/home/{{ $products->id }}" >
            @csrf
            @method('DELETE')
            <button class="button" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
            </div>
            @endif
            @endauth

</div>
             
<div style="margin:auto; margin-top:20px">  
            @if(Auth()->user() && Auth()->user()->role == 'Member')
            @if(Auth()->user())
            <a href="/home/add-to-cart/{{ $products->id }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a>

            @else
            <a href="/home/add-to-cart/{{ $products->id }}" class="btn-secondary btn-block text-center" role="button">Add to cart</a>
            @endif
            @endif

           
</div>
            </div>
            </div>
            
</div>


@endsection