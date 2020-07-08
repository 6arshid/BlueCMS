@include('admin.includes.header')
<form method="post" action="/admin/products/add_new_attribute" enctype="multipart/form-data">
{{csrf_field()}}
    <h3>Title :</h3>
    <input type="text" class="form-control btn-lg" placeholder="Please type title" name="attribute_title">
    <br>
    <h3>Price :</h3>
    <input type="number" class="form-control btn-lg" placeholder="Please type price" name="attribute_price">
    <h3>Image :</h3>
    <input type="file" class="form-control btn-lg" name="image"><br>
    <h3>Language :</h3>
    <input type="text" class="form-control btn-lg" placeholder="Please type lang" name="lang">
    <small>ex. fa </small>
    <div class="line"></div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <input type="submit" class="btn btn-success btn-lg btn-block" value="Send">
</form>

@include('admin.includes.footer')