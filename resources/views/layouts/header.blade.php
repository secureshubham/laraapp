<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield("title")</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto ">
            <li class="nav-item">
              <a class="nav-link" href="{{route('registerpage')}}">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('product.myproducts')}}">Products</a>
            </li>
           
            @if(auth()->check())
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <li class="nav-item">
                  <input type="submit" class="logout-btn nav-link" value="Logout"></input>
                </li>
            </form>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{route('userloginpage')}}">Login</a>
            </li>
            @endif
          </ul>
         
          {{-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> --}}
        </div>
      </nav>
</header>
<main>