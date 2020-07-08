@include('admin.includes.header')
<form method="post" action="/admin/posts/add_new_category" enctype="multipart/form-data">
{{csrf_field()}}
    <h3>Title :</h3>
    <input type="text" class="form-control btn-lg" placeholder="Please type title" name="title">
    <br>
    <h3>Url Name :</h3>
    <input type="text" class="form-control btn-lg" name="url"><br>
    <h3>Image :</h3>
    <input type="file" class="form-control btn-lg" name="image"><br>


    <br>
    <h3>Tags :</h3>
    <input type="text" data-role="tagsinput" class="form-control btn-lg" name="tags"
                            placeholder="{{ trans('sentence.Enter_tags')}}">
    <div class="line"></div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <input type="submit" class="btn btn-success btn-lg btn-block" value="Send">
</form>

@include('admin.includes.footer')