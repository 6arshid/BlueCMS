<?php

namespace App\Http\Controllers;

use App\Article;
use App\Robot;
use Illuminate\Http\Request;
use DonatelloZa\RakePlus\RakePlus;
use Illuminate\Support\Facades\Validator;
use KubAT\PhpSimple\HtmlDomParser;

class RobotsController extends Controller
{
    public function show_robots()
    {
        $show = Robot::get();
        return view('admin.robots_all',compact('show'));
    }
    public function last_get_data($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    public function last_getkeyword($keyword) 
    {
        $keywords = array();
        $data = $this->last_get_data('http://suggestqueries.google.com/complete/search?output=firefox&client=firefox&hl=en-US&q='.urlencode($keyword));
       
        if (($data = json_decode($data, true)) !== null) {
            $keywords = $data[1];
        }
        
        $string = '';
        $i = 1;
        foreach ($keywords as $k) 
        {
            $string .= $k . ', ';
            if ($i++ == 10) break;
        }
        return $string;
    }
    public function file_get_contents_curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    public function get_image_thumbnail($url)
    {
        $vine = file_get_contents($url);
        preg_match('/property="og:image" content="(.*?)"/', $vine, $matches);

        if (!isset($matches[1])) {
            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $vine, $imagex);
           
                $image = $imagex['src'];
            if(!isset($image)){
                $image = null;
            }
        }
       else{
            $image = $matches[1];
        }
        return ($image);
    }
    public function get_content(Robot $robot,$id,Article $article)
    {

     
        
       
        $show = Robot::find($id);
        $rss = simplexml_load_file($show['feed_url']);


        
        $lang = $show['lang'];
        $tags =  $show['tags'];
        $user_id = $show['user_id'];
        echo $rss->channel->title."<br>";
        foreach ($rss->channel->item as $item) {
            $url = $item->link;


            $check_post = Article::find("$url");
            if(empty($check_post)){
                $title =  $item->title;
                $content = $item->description;
                
                // $keywords = RakePlus::create($title)->keywords();
                
                // $tags = implode(',', $keywords);

                // google keyword suggestion
                // $keyx = $this->last_getkeyword("iran");

                
                $image = $this->get_image_thumbnail("$url");
                Article::create([
                    'title'=>$title,
                    'content'=>$content,
                    'user_id'=>$user_id,
                    'image'=>$image,
                    'url'=>$url,
                    'tags'=>$tags,
                    'lang'=>$lang,
                    'feed_source'=>$url,
                ]);
            }else{
                echo "Before added !";
            }
        }

    }
    public function simple_html(){
//         $dom = HtmlDomParser::str_get_html( $str );

// $dom = HtmlDomParser::file_get_html( $file_name );

// $elems = $dom->find($elem_name);
    }
    
}
