@extends('layouts.app')

@section('content')

<div class="flex-center position-ref full-height">





    <div class="content">


        <div class="links">
            <ul class="navbar-nav mr-auto">
                <li class="">
                    <div class="text-center">

                        @php

                        if($menus == null){
                        echo " <a href='https://github.com/laravel/laravel'>GitHub</a>";
                        }
                        @endphp
                        @foreach($menus as $menuX)

                        <a href="{{$menuX->url}}" class="btn btn-light">{{$menuX->title}}</a>


                        @endforeach
                    </div>
                </li>
            </ul>

        </div>
        <hr>
        <div class="container">


            <h3>
                SHOP
                <small class="text-muted">With faded secondary text</small>
            </h3>
            <hr>

            <div class="row">





            @foreach($product as $post)
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <img src="/uploads/images/{{$post->image}}" class="card-img-top" width="100%">
                            <div class="card-body">
                                <h1 class="card-title"> <a href="/product/{{$post->id}}" class="">{{$post->title}}</a> </h1>
                                <p class="card-text"> @php

                                    echo Str::substr($post->content, 0, 371);
                                    @endphp</p>
                                <a href="/product/{{$post->id}}" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
                <hr>
                {{ $product->links() }}
        </div>
    </div>
</div>

@endsection