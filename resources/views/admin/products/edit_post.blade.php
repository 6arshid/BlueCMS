@include('admin.includes.header')


<form method="post" action="/admin/posts/edit_post/{{$article->id}}" enctype="multipart/form-data">
{{ csrf_field() }}

@method('PATCH')
    <h3>Title :</h3>
    <input type="text" class="form-control btn-lg" placeholder="Please type title" value="{{$article->title}}" name="title">
    <br>
    <h3>Content :</h3>
    <textarea class="form-control" rows="15" name="content">{!! $article->content !!}</textarea><br>
    <h3>Image :</h3>
    <input type="file" class="form-control btn-lg" name="image"><br>
    <h3>Language :</h3>
    <input type="text" class="form-control btn-lg" placeholder="Please type lang" name="lang" value="{{$article->lang}}">
    <small>ex. fa </small>

    <br>
    <h3>Tags :</h3>
    <input type="text" data-role="tagsinput" class="form-control btn-lg" name="tags"
                            placeholder="{{ trans('sentence.Enter_tags')}}" value="{{$article->tags}}">
    <div class="line"></div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <input type="submit" class="btn btn-success btn-lg btn-block" value="Send">
</form>

@include('admin.includes.footer')