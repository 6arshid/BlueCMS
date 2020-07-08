@include('admin.includes.header')


<form method="post" action="/admin/update_menus_byid/{{$menu->id}}" enctype="multipart/form-data">
    {{ csrf_field() }}

    @method('PATCH')
    <h3>Title :</h3>
    <input type="text" class="form-control btn-lg" placeholder="Please type title" value="{{$menu->title}}" name="title"><br>
    <input type="text" class="form-control btn-lg" placeholder="Please type color" value="{{$menu->color}}" name="color">



    <h3>Icon :</h3>
    <input type="file" class="form-control btn-lg" name="image"><br>
    <h3>Language :</h3>
    <input type="text" class="form-control btn-lg" placeholder="Please type lang" name="lang" value="{{$menu->lang}}">
    <small>ex. fa </small>

    <br>
    <input type="text" data-role="tagsinput" class="form-control btn-lg" name="parent_id" placeholder="{{ trans('sentence.Enter_parent_id')}}" value="{{$menu->parent_id}}"><br>
    <input type="text" data-role="tagsinput" class="form-control btn-lg" name="url" placeholder="{{ trans('sentence.Enter_url')}}" value="{{$menu->url}}">
    <div class="line"></div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <input type="submit" class="btn btn-success btn-lg btn-block" value="Send">
</form>

@include('admin.includes.footer')