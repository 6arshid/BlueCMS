

@include('admin.includes.header')



@foreach($setting_data as $row)






<form method="post" action="/admin/pages/add_new_page" enctype="multipart/form-data">
    {{csrf_field()}}
    <h5>Title :</h5>
    <input type="text" class="form-control btn-lg" placeholder="Please type title" value=" {{$row->title}}" name="title">
    <br>
    <h5>Description :</h5>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css"
          rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js">
    </script>

    <textarea id="summernote" name="description">{{$row->description}}</textarea>

    <script>
        $('#summernote').summernote({
            placeholder: '{{ trans('sentence.Enter_content')}}',
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

    <h5>Keywords :</h5>
    <input type="text" data-role="tagsinput" value="{{$row->tags}}" class="form-control btn-lg" name="tags"
           placeholder="{{ trans('sentence.Enter_tags')}}">


    <br>

    <h5>Language :</h5>
    <input type="text" class="form-control btn-lg" placeholder="Please type lang" value="{{$row->lang}}" name="lang">
    <small>ex. fa </small>
    <br>

    <h5>Email for received mail from site :</h5>
    <input type="text" class="form-control btn-lg" placeholder="Please type lang" value="{{$row->email_received}}" name="email_received">
    <br>
    <h5>Email for send mail from site</h5>
    <input type="text" class="form-control btn-lg" placeholder="Please type lang" value="{{$row->email_send}}" name="email_send">
    <br>

    <h5>Site Url</h5>
    <input type="url" class="form-control btn-lg" placeholder="Please type lang" name="site_url"  value="{{$row->site_url}}">
    <div class="line"></div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <input type="submit" class="btn btn-success btn-lg btn-block" value="Send">
</form>
@endforeach
@include('admin.includes.footer')
