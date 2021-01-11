@extends('layouts.app')

@section('content')
<div id="wrapper">
	<div id="page" class="container">
    <h1 class="heading has-text-weight-bold is-size-4">New Product</h1>

    <form method="POST" action="/home">
    @csrf
        <div class="field">
            <label class="label" for="name">Name</label>

            <div class="control">
                <input class="input" 
                type="text" 
                name="name" 
                id="name"
                value="{{ old('name') }}">

            </div>
        </div>

        <div class="field">
            <label class="label" for="img">Image</label>

            <div class="control">
                <input class="input" 
                    name="img" 
                    id="img"
                    >{{ old('img') }}</input>
               
                
            </div>
        </div>

        <div class="field">
            <label class="label" for="Price">Price</label>

            <div class="control">
                <input class="input" 
                    type="number"
                    name="Price" 
                    id="Price"
                    >{{ old('Price') }}</textarea>
                
            </div>
        </div>

        <div class="field">
            <label class="label" for="Description">Description</label>

            <div class="control">
                <textarea class="textarea" 
                    name="Description" 
                    id="Description"
                    >{{ old('Description') }}</textarea>
               
            </div>
        </div>

        <div class="field">
            <label class="label" for="Quantity">Quantity</label>

            <div class="control">
                <input class="input" 
                    type="number"
                    name="Quantity" 
                    id="Quantity"
                    >{{ old('Quantity') }}</textarea>
                
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