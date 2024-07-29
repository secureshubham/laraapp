@extends("layouts.layout")
@section("title","Register")
@section("content")

<div class="container">
    <div class="row justify-content-center m-5 ">
        <div class="col-6 border p-5">
           <div class="row justify-content-center">
            <div class="col-5">
                <h2>Register</h2>
            </div>
            </div> 
            <form method="POST" action="{{route('newuserregister')}}">
                @csrf
                @method('post')
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="name" class="form-control" >
                </div>
                <div class="form-group">
                  <label for="useremail">Useremail</label>
                  <input type="email" name="email" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="userpass">Password</label>
                  {{-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> --}}
                  <input type="password" class="form-control"  name="password">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
              </form>
                @if($errors->any())
                <div class="alert alert-danger">
                {{-- {{dd($errors->all())}} --}}
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
                </div>
                @endif 
        </div>
    </div>
</div>
@endsection