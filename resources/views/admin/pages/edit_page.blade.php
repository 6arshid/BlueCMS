@include('admin.includes.header')


<form method="post" action="/admin/update_pages_byid/{{$page->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}

    @method('PATCH')
    <h3>Title :</h3>
    <input type="text" class="form-control btn-lg" placeholder="Please type title" value="{{$page->title}}" name="title">
    <br>
    <h3>Content :</h3>
    



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js">
    </script>

    <textarea id="summernote" name="content">{!! $page->content !!}</textarea>

    <script>
        $('#summernote').summernote({
            placeholder: 'page',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
    <h3>Image :</h3>
    <input type="file" class="form-control btn-lg" name="image"><br>
    <h3>Language :</h3>
    <input type="text" class="form-control btn-lg" placeholder="Please type lang" name="lang" value="{{$page->lang}}">
    <small>ex. fa </small>

    <br>
    <h3>Tags :</h3>
    <input type="text" data-role="tagsinput" class="form-control btn-lg" name="tags" placeholder="{{ trans('sentence.Enter_tags')}}" value="{{$page->tags}}">
    <div class="line"></div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <input type="submit" class="btn btn-success btn-lg btn-block" value="Send">
</form>

@include('admin.includes.footer')