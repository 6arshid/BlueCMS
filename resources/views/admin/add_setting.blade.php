

@include('admin.includes.header')





<form method="post" action="/admin/add_setting" enctype="multipart/form-data">
    {{csrf_field()}}
    <h5>Title :</h5>
    <input type="text" class="form-control btn-lg" placeholder="Please type title"  name="title">
    <br>
    <h5>Description :</h5>
  

    <textarea  name="description" class="form-control btn-lg"></textarea>

  

    <h5>Keywords :</h5>
    <input type="text" data-role="tagsinput" class="form-control btn-lg" name="tags"
           placeholder="{{ trans('sentence.Enter_tags')}}">


    <br>

    <h5>Language :</h5>
    <input type="text" class="form-control btn-lg" placeholder="Please type lang" name="lang">
    <small>ex. fa </small>
    <br>

    <h5>Email for received mail from site :</h5>
    <input type="text" class="form-control btn-lg" placeholder="Please type lang" name="email_received">
    <br>
    <h5>Email for send mail from site</h5>
    <input type="text" class="form-control btn-lg" placeholder="Please type lang"  name="email_send">
    <br>

    <h5>Site Url</h5>
    <input type="url" class="form-control btn-lg" placeholder="Please type lang" name="site_url" >
    <div class="line"></div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <input type="submit" class="btn btn-success btn-lg btn-block" value="Send">
</form>
@include('admin.includes.footer')
