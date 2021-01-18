@extends('layouts.app')

@section('content')
<div id="wrapper">
	<div id="page" class="container">
    <h1 class="heading has-text-weight-bold is-size-4">New Product</h1>

    <form method="POST" action="/">
    @csrf
        <div class="field">
            <label class="label" for="name">Name</label>

            <div class="control">
                <input class="form-control @error('name') is-invalid @enderror" 
                type="text" 
                name="name" 
                id="name"
                ></input>
            @error('name')
            <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
            </span>
             @enderror
            </div>
        </div>

        <div class="field">
            <label class="label" for="img">Image</label>

            <div class="control">
                <input class = "input"
                    type="text"
                    name="img" 
                    id="img"
                    ></input>
               
            </div>
        </div>

        <div class="field">
            <label class="label" for="Price">Price</label>

            <div class="control">
                <input class="form-control @error('Price') is-invalid @enderror"  
                    type="number"
                    name="Price" 
                    id="Price"
                    ></textarea>
                @error('Price')
                <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                </span>
                @enderror
                
            </div>
        </div>

        <div class="field">
            <label class="label" for="Description">Description</label>

            <div class="control">
                <textarea class="textarea form-control @error('Description') is-invalid @enderror"
                    name="Description" 
                    id="Description"
                    ></textarea>
                @error('Description')
                <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                </span>
                @enderror
               
            </div>
        </div>

        <div class="field">
            <label class="label" for="Quantity">Quantity</label>

            <div class="control">
                <input class="form-control @error('Quantity') is-invalid @enderror" 
                    type="number"
                    name="Quantity" 
                    id="Quantity"
                    ></textarea>
                @error('Quantity')
                <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                </span>
                @enderror
                
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
            <button class="btn btn-primary" type="submit">Submit</button>
            </div>
            
            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
        </div>
    </form>

    </div>
</div>
@endsection