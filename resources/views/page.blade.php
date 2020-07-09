@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('flash-message')
            <h3>
                <a href="/p/{{$rows->id}}/{{$rows->title}}">{{$rows->title}}</a>


            </h3><small class="text-muted"> <a href="/p/{{$rows->id}}"> {{$rows->created_at->diffForHumans()}}</a>
            </small>
            <hr>
            <a href="/p/{{$rows->id}}"><img src="/uploads/images/{{$rows->image}}" width="100%"></a>
            <br>
            {!!$rows->content!!}

        </div>
    </div>
</div>
@endsection