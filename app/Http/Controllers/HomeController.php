<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Reaction;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Spotify;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'title' => ['required', 'string'],
    //         'content' => ['required', 'string'],
    //         'url' => ['required', 'string'],
    //         'tags' => ['required', 'max:173'],

    //     ]);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
    public function index()
    {
        //    $x = Spotify::searchTracks('Closed on Sunday')->get();

        return view('home');
    }
    public function wall()
    {
        $user = auth()->user();
        $instaft = $user->instagram_follow_tags;
        $instausername = $user->instagram_user_name;
        $fbusername = $user->facebook_follow_tags;
        $ytusername = $user->youtube_follow_tags;

        $instax = "http://last.today/rss-bridge-x/?action=display&bridge=Instagram&context=Hashtag&h=" . $instaft . "&media_type=all&format=Html";
        $instauser = "http://last.today/rss-bridge-x/?action=display&bridge=Instagram&context=Username&u=" . $instausername . "&media_type=all&format=Html";
        $fbuser = "http://last.today/rss-bridge-x/?action=display&bridge=Facebook&context=User&u=" . $fbusername . "&media_type=all&limit=-1&format=Html";
        $ytuser = "http://last.today/rss-bridge-x/?action=display&bridge=Youtube&context=By+username&u=" . $ytusername . "&duration_min=&duration_max=&format=Html";

        $curl = $this->file_get_contents_curl($instax);
        $curl2 = $this->file_get_contents_curl($instauser);
        $curl3 = $this->file_get_contents_curl($fbuser);
        $curl4 = $this->file_get_contents_curl($ytuser);

        $start_html_content = 'section class="feeditem"';
        $end_html_content = 'section';
        preg_match_all("'<" . $start_html_content . ">(.*?)<\/" . $end_html_content . ">'si", $curl, $matches);
        preg_match_all("'<" . $start_html_content . ">(.*?)<\/" . $end_html_content . ">'si", $curl2, $matches2);
        preg_match_all("'<" . $start_html_content . ">(.*?)<\/" . $end_html_content . ">'si", $curl3, $matches3);
        preg_match_all("'<" . $start_html_content . ">(.*?)<\/" . $end_html_content . ">'si", $curl4, $matches4);

        return view('wall', compact('matches', 'matches2', 'matches3', 'matches4', 'curl', 'curl2', 'curl3', 'curl4'));
    }
    public function check_admin_login()
    {
        $user = auth()->user();
        $user_id = $user->id;
        $user_admin = $user->is_admin;

        if ($user_admin == '1') {
            die();
        } else {
            echo "error";
        }
    }
    public function flolow_setting()
    {

        return view('auth.social_setting');
    }
    public function view_form_article()
    {
        return view('articles.add_articles');
    }

    public function submit_form_article(Request $request, Article $article, User $user)
    {


        $source = $this->file_get_contents_curl($request['url']);

        preg_match('/<meta property="og:image" content="(.*?)" \/>/', $source, $matches);

        if (!isset($matches[1])) {
            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $source, $image);
            if (!isset($image['src'])) {
                $uniqid = null;
            } else {
                $uniqid = $image['src'];
            }
        } else {
            $image_url = $matches[1];
            $uniqid = 'image-' . uniqid()  . '.jpg';
            $img = 'uploads/' . $uniqid;
            $ch = curl_init($image_url);
            $fp = fopen($img, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        }
        $user = auth()->user();
        $user_id = $user->id;
        $user_lang = $user->language;



        $data = Article::create([
            'title' => $request['title'],
            'tags' => $request['tags'],
            'url' => $request['url'],
            'content' => $request['content'],
            'user_id' => $user_id,
            'image' => $uniqid,
            'lang' => $user_lang,
        ]);

        $last_id = $data->id;

        $show_article = "/p/" . $last_id .$request['title'];
        return redirect("$show_article");
    }
    public function send_comment(Request $request, Article $article)
    {

        $user = auth()->user();

        $user_id = $user->id;

        $article_id = $request['post_id'];
        Comment::create([
            'user_id' => $user_id,
            'post_id' => $request['post_id'],
            'comment' => $request['comment'],

        ]);
        return redirect("/p/$article_id/#comment")->with('success', trans('sentence.Hoorayycsr'));
    }

    public function user_setting()
    {
        return view('auth.profile-edit');
    }
    public function post_reaction(Request $request)
    {
        $user = auth()->user();

        $user_id = $user->id;
        $article_id = $request['post_id'];
        $currentTimeinSeconds = time();
        $currentDate = date('Y-m-d', $currentTimeinSeconds);
        $checker = Reaction::select('*')->where([
            ['post_id', '=', $article_id],
            ['user_id', '=', $user_id],
            ['date', '=', $currentDate]
        ])->first();
        if (is_null($checker)) {
            Reaction::create([
                'user_id' => $user_id,
                'post_id' => $request['post_id'],
                'reaction' => $request['reaction'],
                'date' => $currentDate,

            ]);
            return redirect("/p/$article_id")->with('success', trans('sentence.reaction_submited'));
        } else {

            return redirect("/p/$article_id")->with('error', trans('sentence.reaction_submited_error'));;
        }
    }

    public function user_update_setting(User $user, Request $request)
    {
        $user = auth()->user();
        $user_id = $user->id;

        $rows = User::where('id', '=', $user_id)->first();

        $rows->update($request->all());
        return back();
    }
    public function user_update_avatar(User $user, Request $request)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $data = app('request');
        if ($request->hasfile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('../../uploads/avatars/' . $filename));
            $row = User::where('id', '=', $user_id)->update(array('avatar' => $filename));
        }


        return back();
    }

    public function special_post()
    {
        return view('layouts.special_post');
    }

    public function submit_special_post(Request $request, Article $article, User $user)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $user_lang = $user->language;

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $data = app('request');
        if ($request->hasfile('image')) {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(1024, 768)->save(public_path('../../uploads/images/' . $filename));
            $url_image = "http://last.today/uploads/images/" . $filename;
        }
        $data = Article::create([
            'title' => $request['title'],
            'tags' => $request['tags'],
            'url' => 'no_url',
            'content' => $request['content'],
            'user_id' => $user_id,
            'image' => $url_image,
            'lang' => $user_lang,
        ]);

        $last_id = $data->id;

        $show_article = "/p/" . $last_id;
        return redirect("$show_article");
    }
    public function show_twitter_wall()
    {
        $user = auth()->user();
        $twitter = $user->twitter_username_for_follow;
        return view('home.twitter', compact('twitter'));
    }
    public function show_facebook_wall()
    {
        $user = auth()->user();
        $fbusername = $user->facebook_follow_tags;

        $fbuser = "http://last.today/rss-bridge-x/?action=display&bridge=Facebook&context=User&u=" . $fbusername . "&media_type=all&limit=-1&format=Html";


        $curl3 = $this->file_get_contents_curl($fbuser);

        $start_html_content = 'section class="feeditem"';
        $end_html_content = 'section';

        preg_match_all("'<" . $start_html_content . ">(.*?)<\/" . $end_html_content . ">'si", $curl3, $facebook);
        return view('home.facebook', compact('facebook', 'curl3'));
    }
    public function show_youtube_wall()
    {
        $user = auth()->user();
        $ytusername = $user->youtube_follow_tags;
        $ytuser = "http://last.today/rss-bridge-x/?action=display&bridge=Youtube&context=By+username&u=" . $ytusername . "&duration_min=&duration_max=&format=Html";


        $curl3 = $this->file_get_contents_curl($ytuser);

        $start_html_content = 'section class="feeditem"';
        $end_html_content = 'section';

        preg_match_all("'<" . $start_html_content . ">(.*?)<\/" . $end_html_content . ">'si", $curl3, $youtube);
        return view('home.youtube', compact('youtube', 'curl3'));
    }
    public function show_flicker_wall()
    {
        $user = auth()->user();
        $flicker_keyword = $user->flicker_keyword;
        $flicker = "http://last.today/rss-bridge-x/?action=display&bridge=Flickr&context=By+keyword&q=" . $flicker_keyword . "&format=Html";


        $curl3 = $this->file_get_contents_curl($flicker);

        $start_html_content = 'section class="feeditem"';
        $end_html_content = 'section';

        preg_match_all("'<" . $start_html_content . ">(.*?)<\/" . $end_html_content . ">'si", $curl3, $flicker);
        return view('home.flicker', compact('flicker', 'curl3'));
    }
    public function show_instagram_wall()
    {
        $user = auth()->user();
        $insta_username = $user->instagram_user_name;
        $instagram = new \InstagramScraper\Instagram();
        $response = $instagram->getPaginateMedias($insta_username);
        return view('home.instagram', compact('instagram', 'response'));
    }
}
