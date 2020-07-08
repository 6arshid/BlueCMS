@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
     
            @include('flash-message')

            <div class="card">

                <h1 class="card-header"> <a href="/p/{{$rows->id}}/{{$rows->title}}">{{$rows->title}}</a></h1>

                <div class="card-body">
                    <a href="/p/{{$rows->id}}"><img src="/uploads/images/{{$rows->image}}" width="100%"></a>
                    <a href="/p/{{$rows->id}}"> {{$rows->created_at->diffForHumans()}}</a>




                    {!!$rows->content!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection