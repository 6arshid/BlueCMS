@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
     
            @include('flash-message')

            <div>

                <h1> <a href="/p/{{$article->id}}/{{$article->title}}">{{$article->title}}</a></h1>

                <div >
                    <a href="/p/{{$article->id}}"><img src="/uploads/images/{{$article->image}}" width="100%"></a>
                    <a href="/p/{{$article->id}}"> {{$article->created_at->diffForHumans()}}</a>




                    {!!$article->content!!}
                </div>
            </div>
            @include('layouts.comments')

        </div>
    </div>
</div>
@endsection