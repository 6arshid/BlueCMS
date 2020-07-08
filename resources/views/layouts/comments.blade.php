<div class="post-comments">





    @foreach($comments as $root)
    @php
    $email = $root->user->email;
    @endphp


    <div class="post-comments-single">
        <div class="post-comment-avatar">
            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="">
        </div>
        <div class="post-comment-text">
            <div class="post-comment-text-inner">
                <h6> {{ Auth::user()->name }}</h6>
                <p> {{$root->comment}}</p>
            </div>
            <div class="uk-text-small">
                <a href="#" class="text-danger mr-1"> <i class="uil-heart"></i> {{ trans('sentence.like')}} </a>
                <a href="#" class=" mr-1"> {{ trans('sentence.reply')}} </a>
                <span> {{$root->created_at->diffForHumans()}}</span>
            </div>
        </div>
    </div>


    @endforeach

    @guest
    <hr>

    {{ trans('sentence.For_Send_Comment_Must')}} <a class="btn btn-info" href="{{ route('login') }}">{{ __('Login') }}</a>

    @if (Route::has('register'))
    {{ trans('sentence.Or')}} <a class="btn btn-success" href="{{ route('register') }}">{{ __('Register') }}</a>
    @endif
    @else

    <form action="/articles/submit_comment" method="post">
        {{csrf_field()}}
        <div class="form-group">

            <div class="post-add-comment-avature">
            @php
            
            if(Auth::user()->avatar == null){
            echo " <img src='/uploads/Auth::user()->avatar'>
            ";
            }else{
            echo " <img src='/uploads/logo.jpg' width=\"60px\" class='pull-left'>
            ";
            }

            @endphp
            </div>
            <div class="post-add-comment-text-area">
                <input type="text" placeholder="{{ trans('sentence.Enter_Comment')}}" name="comment" class="form-control" required>
                <div class="icons">
                    <span class="uil-link-alt"></span>
                    <span class="uil-grin"></span>
                    <span class="uil-image"></span>
                </div>
            </div>

        </div>

        <input type="hidden" value="{{$article->id}}" name="post_id">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <!--         <button class="button primary">{{ trans('sentence.Send_Comment')}}</button>
 -->
    </form>




    @endguest





</div>