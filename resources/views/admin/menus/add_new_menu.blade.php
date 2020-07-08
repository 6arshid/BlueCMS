@include('admin.includes.header')


<a class="btn btn-info" href="/admin/menus/show_all">Show All</a> <br><br>


<form method="post" action="/admin/menus/add_new_menu" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="text" class="form-control btn-lg" placeholder="Please type title" name="title"><br>
    <input type="url" class="form-control btn-lg" placeholder="Please type url" name="url"><br>
    <input type="text" class="form-control btn-lg" placeholder="Please type language" name="lang"><br>
    <input type="text" class="form-control btn-lg" placeholder="Please type Parent category id" name="parrent_id"><br>
    <input type="file" class="form-control btn-lg" placeholder="Please type url" name="icon"><br>

    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <input type="submit" class="btn btn-success btn-lg btn-block" value="Send">
</form>

@include('admin.includes.footer')