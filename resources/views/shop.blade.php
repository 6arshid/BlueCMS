<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
        }



        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .avatar_logo img {
            border-radius: 50%;
            width: 13%;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">




        @if (Route::has('login'))
        <div class="top-right links">


            @if (auth()->check())
            @if (auth()->user()->is_admin === 1)

            <a href="/admin/home">Admin</a>

            @else
            Hello standard user
            @endif
            @endif



            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="m-b-md">
                <h2> <a href="/">Blue CMS</h2>
                <div class="avatar_logo">
                    <a href="/"><img src="/uploads/user/mrlast.jpg" alt="Avatar"></a>
                </div>
            </div>

            <div class="links">
                @php

                if($menus == null){
                echo " <a href='https://laravel.com/docs'>Docs</a>
                <a href='https://laracasts.com'>Laracasts</a>
                <a href='https://laravel-news.com'>News</a>
                <a href='https://blog.laravel.com'>Blog</a>
                <a href='https://nova.laravel.com'>Nova</a>
                <a href='https://forge.laravel.com'>Forge</a>
                <a href='https://vapor.laravel.com'>Vapor</a>
                <a href='https://github.com/laravel/laravel'>GitHub</a>";
                }
                @endphp
                @foreach($menus as $menuX)

                <a href="{{$menuX->url}}">{{$menuX->title}}</a>


                @endforeach

            </div>
            <hr>
            <div class="container">


                <h1>shop</h1>

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
</body>

</html>