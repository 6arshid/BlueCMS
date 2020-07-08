@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Articles</div>
                <div class="card-body">
                    @if($articles->count())
                        @foreach($articles as $article)
                            <article class="col-xs-12 col-sm-6 col-md-3">
                                <div class="cart cart-info">id }}">
                                    <div class="cart-body">
                                        <a href="https://www.pakainfo.com/upload/itsolutionstuff.png" title="Nature Portfolio">
                                            <img src="https://www.pakainfo.com/upload/itsolutionstuff.png" alt="Nature Portfolio" />
                                            <span class="overlay"><i class="fa fa-search"></i></span>
                                        </a>
                                    </div>  
                                    <div class="cart-footer">
                                        <h4><a href="#" title="Nature Portfolio">{{ $article->title }}</a></h4>
                                        <span class="pull-right">
                                            <span class="impress-btn">
                                                <i>id}}" class="glyphicon glyphicon-likes-up {{ auth()->user()->hasLiked($article) ? 'paka-page' : '' }}"></i> <div>id}}-bs3">{{ $article->likers()->get()->count() }}</div>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    $(document).ready(function() {     
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('i.glyphicon-likes-up, i.glyphicon-likes-down').click(function(){    
            var id = $(this).parents(".cart").data('id');
            var c = $('#'+this.id+'-bs3').html();
            var pakaionid = this.id;
            var pOjb = $(this);
            $.ajax({
               type:'POST',
               url:'/ajaxRequest',
               data:{id:id},
               success:function(data){
                  if(jQuery.isEmptyObject(data.success.attached)){
                    $('#'+pakaionid+'-bs3').html(parseInt(c)-1);
                    $(pOjb).removeClass("paka-page");
                  }else{
                    $('#'+pakaionid+'-bs3').html(parseInt(c)+1);
                    $(pOjb).addClass("paka-page");
                  }
               }
            });
        });      
        $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });                                        
    }); 
@endsection