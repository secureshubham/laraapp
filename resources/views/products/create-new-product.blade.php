@extends("products.layout") 
@section('content')
<div class="product-container">
    <div class="row justify-content-center m-5 ">
        <div class="col-6 border p-5">
            <div class="row justify-content-center">
                <div class="col-6">
                    <h2>Create New Product</h2>
                </div>
            </div>
    <form method="POST" action="{{route('new.product.create')}}">
        @csrf
        @method('post')
        <div class="form-group">
            <label for="productname">Product name</label>
            <input type="text" name="prod_name" class="form-control" value="{{ old('prod_name') }}">
            {{-- @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('prod_name') }}</strong>
            </span>
        @endif --}}
        </div>
        <div class="form-group">
            <label for="productqty">Product Qty</label>
            <input type="text" name="prod_qty" class="form-control" value="{{ old('prod_qty') }}">
        </div>
        <div class="form-group">
            <label for="productprice">Product Price</label>
            <input type="text" name="prod_price"  class="form-control" value="{{ old('prod_price') }}">
        </div>
        <div class="form-group">
            <label for="productdesc">Description</label>
            <input type="text" name="prod_desc" class="form-control" value="{{ old('prod_desc') }}">
        </div>        
        <div class="form-group">
        <input type="submit" value="Create" class="form-control btn-primary">
        </div>
    </form>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{-- {{dd($errors->all())}} --}}
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif 
</div>
</div>
</div>
@endsection