@extends("products.layout") 
@section('content')
@php 
// dd($allproducts);
$current_user_id = auth()->id()
@endphp
<div class="card">
  <div class="card-header">All Products</div>
  <div class="card-body">
    @if ($current_user_id)
    <a href="{{route('product.create')}}">Create New Product</a>
    @endif
   <table border 1px solid black;>
    <tbody>
      @if($allproducts->isNotEmpty())
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Description</th>
            @if ($allproducts->contains('userid', $current_user_id))
            <th>Update</th>
            <th>Delete</th>
            @endif
        </tr>
       @endif
        @forelse($allproducts as $id => $product )
        <tr>
            <td>{{ $product->pname }}</td>
            <td>{{ $product->pqty }}</td>
            <td>{{ $product->pprice }}</td>
            <td>{{ $product->pdescription }}</td>
            @if($current_user_id == $product->userid )
            <td><a href="{{route('update.product.page',$product->id)}}">Update</a></td>
            <td><a href="{{route('delete.product',$product->id)}}">Delete</a></td>
            @endif
        </tr>
        @empty
        <div class="bg-danger">
          <p>Not Found</p>
        </div>
         @endforelse
    </tbody>        
    </table> 
  </div>
  
</div>
@endsection