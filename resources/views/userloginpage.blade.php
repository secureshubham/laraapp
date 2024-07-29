@extends("layouts.layout")
@section("title","Login")
@section("content")

<div class="container">
    <div class="row justify-content-center m-5 ">
        <div class="col-6 border p-5">
           <div class="row justify-content-center">
            <div class="col-5">
                <h2>Login</h2>
            </div>
            </div> 
            <form method="POST" action="{{route('loginauth')}}">
                @csrf
                @method('post')
                <div class="form-group">
                  <label for="useremail">Email</label>
                  <input type="email" class="form-control" name="email">
                  {{-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> --}}
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="userpass">Password</label>
                  {{-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> --}}
                  <input type="password" class="form-control"  name="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
              </form>
              @if($errors->any())
              <div class="alert alert-danger m-2">
                      {{-- {{dd($errors->all())}} --}}
                      @foreach($errors->all() as $error)
                          <p>{{ $error }}</p>
                      @endforeach
              </div>
              @endif 
        </div>
    </div>
</div>


{{-- <form method="POST" action="{{route('loginauth')}}">
        @csrf
        @method('post')
        <label for="useremail">Email</label>
        <input type="email" name="email">
        <label for="userpass">Password</label>
        <input type="password" name="password">
        <input type="submit" value="Login">
</form> --}}

@endsection
