<!-- saved from url=(0050)https://subscribe.babaei.net/?lang=fa&contact-form -->
<html>

<head>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name', 'BlueCMS') }}</title>

    <meta http-equiv="refresh" content="120">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="/js/tagsinput.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet" type="text/css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/fontawesome.min.css" rel="stylesheet" type="text/css">
    <link href="/css/wt-fsex300.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="full-width full-height">
        <div class="container-table">
            <div class="row v-center">
                <div class="col-xs-10 col-sm-10 col-md-8 col-lg-8 h-center">
                    <span class="error-code">
                        <a href="/"> {{ config('app.name', 'BlueCMS') }}</a>
                    </span>
                    <hr>
                    <div class="col-md-12">



                        @guest

                        <a href="{{ route('login') }}">{{ __('Login') }}</a>@if (Route::has('register'))|<a href="{{ route('register') }}">{{ __('Register') }}</a>

                        @endif
                        @else
                        <a id="navbarDropdown"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        
                            <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                           |     {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                     
                        @endguest
                    </div>

                    @yield('content')
                    <hr>
                    <span class="links">
                        <a href="/">
                            <i class="fas fa-igloo fa-lg"></i>
                        </a>
                        <a href="/blog">
                            <i class="fas fa-blog fa-lg"></i>
                        </a>
                        <a href="/portfolio">
                            <i class="fab fa-envira fa-lg"></i>
                        </a>

                        <a href="/shop">
                            <i class="fas fa-shopping-basket fa-lg"></i>
                        </a>
                        <a href="/about">
                            <i class="fas fa-address-card fa-lg"></i>
                        </a>

                        <a href="mailto:samson@mrlast.com">
                            <i class="fas fa-at fa-lg"></i>
                        </a>

                        |

                        <a href="/admin/home">
                            <i class="fas fa-user fa-lg"></i>
                        </a>
                    </span>
                    <hr>

                    <span class="footer">
                        powered by <a href='https://github.com/laravel/laravel' target="_blank">laravel</a> / <a href='https://github.com/01mrlast/BlueCMS' target="_blank">bluecms</a>
                    </span>

                </div>


            </div>



        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/fontawesome.min.js"></script>
</body>

</html>