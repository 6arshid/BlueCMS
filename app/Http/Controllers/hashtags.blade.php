





@include('layouts.header')
<title>{{\Request::get('search')}}</title>
<meta name="description" content="{{\Request::get('search')}}">
@include('layouts.top_left_menu')




        <!-- contents -->
        <div class="main_content">

        <div class="main_content_inner">


<h1> {{\Request::get('search')}} </h1>

@include('layouts.share_post')








<div class="uk-grid-large uk-grid" uk-grid="">
    <div class="uk-width-expand uk-first-column">
    @include('flash-message')
    @foreach($show_hashtags as $hashtag)
        <!-- Blog Post -->
        <a href="/p/{{$hashtag->id}}" class="blog-post">
            <!-- Blog Post Thumbnail -->
            <div class="blog-post-thumbnail">
                <div class="blog-post-thumbnail-inner">
                @php
                              $image = $hashtag->image;
                                $findme = 'http';
                                       $pos = strpos($image, $findme);
                                       if ($pos === false) {
                                           $urlimage = "/uploads/".$image;
                                           echo "<img src='$urlimage'  class='img-fluid rounded w-100'>";
                                       }else{
                                           echo "<img src='$image'  class='img-fluid rounded w-100'>";

               }
                        @endphp
                </div>
            </div>
            <!-- Blog Post Content -->
            <div class="blog-post-content">
         
                <h3>{{$hashtag->title}}</h3>
                <p>{{$hashtag->content}}
                    <hr>
                    @php
                                    $hashtag = $hashtag->tags;
                                    if (!empty($hashtag)) {
                                        $x = explode(",", $hashtag);
                                        foreach($x as $tagsx) {
                                            echo "<span class='blog-post-info-tag button soft-danger'>$tagsx</span>";
                                        }
                                    }
                                @endphp
                </p>
            </div>
        </a>

        @endforeach


        {{ $show_hashtags->appends(request()->except('page'))->links() }}
    </div>
    <div class="uk-width-1-3@s">

    @include('layouts.sidebar')


    </div>
</div>




</div>
        </div>


    </div>

    @include('layouts.footer')
