@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('flash-message')

            <div class="card">

                <h1 class="card-header"> <a href="/product/{{$product->id}}">{{$product->title}}</a></h1>

                <div class="card-body">
                    <a href="/product/{{$product->id}}"><img src="/uploads/images/{{$product->image}}" width="100%"></a>
                    <a href="/product/"> Price :{{$product->price}} $</a>




                    {!!$product->content!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection