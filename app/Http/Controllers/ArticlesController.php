<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Menu;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class ArticlesController extends Controller
{
    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
    public function url_slug($str, $options = array())
    {
        $str = mb_convert_encoding((string) $str, 'UTF-8', mb_list_encodings());

        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => false,
        );

        // Merge options
        $options = array_merge($defaults, $options);

        $char_map = array(
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
            'ÿ' => 'y',

            // Latin symbols
            '©️' => '(c)',

            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',

            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',

            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z',

            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z',

            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z'
        );

        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

        // Transliterate characters to ASCII
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }

        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);

        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }
    public function image_checker($image)
    {
        $findme = 'http';
        $pos = strpos($image, $findme);
        if ($pos === false) {
            $urlimage = "../../uploads/" . $image;
            return $urlimage;
        } else {
            return $image;
        }
    }
    public function postpaginate(Request $request)
    {


        $locale = session()->get('locale');
        if (!empty($locale)) {
            $article = Article::where('lang', $locale)->orderBy('id', 'DESC')->paginate(15);
            if ($request->ajax()) {
                $view = view('data', compact('article'))->render();
                return response()->json(['html' => $view]);
            }
            $random_article = Article::where('lang', $locale)->inRandomOrder()->take(20)->get();
        } else {
            $article = Article::where('lang', 'en')->orderBy('id', 'DESC')->paginate(15);
            if ($request->ajax()) {
                $view = view('data', compact('article'))->render();
                return response()->json(['html' => $view]);
            }
            $random_article = Article::inRandomOrder()->take(20)->get();
        }


        return view('welcome', compact('article', 'random_article'));
    }

    public function get_all()
    {
        $article =  Article::orderBy('id', 'DESC')->paginate(9);
        $menus =  Menu::orderBy('id', 'DESC')->paginate(15);;
        $setting =  Setting::get()->first();
        if (empty($setting)) {
            Setting::create([
                'title' => 'my web site',
                "description" => "i make this website , my personal website its good"
            ]);
            User::create([
                'name' => 'bluecms',
                'email' => 'hi@blue.cms',
                'password' => Hash::make('hi@blue.cms'),
                'user_name' => 'admin',
                'language' => 'en',
                'is_admin' => '1',

            ]);
        }
        return view('welcome', compact('article', 'menus', 'setting'));
    }
    public function get_all_posts()
    {
        $article =  Article::orderBy('id', 'DESC')->paginate(9);
        $menus =  Menu::orderBy('id', 'DESC')->paginate(15);

        return view('blog', compact('article', 'menus'));
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
    public function add_post(Request $request, Auth $controller, Article $article)
    {



        $source = $this->file_get_contents_curl($request['url']);

        preg_match('/<meta property="og:image" content="(.*?)" \/>/', $source, $matches);

        if (!isset($matches[1])) {
            $uniqid = "no-image.jpg";
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
        $userId = '1';


        Article::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'user_id' => $userId,
            'image' => $uniqid,
            'url' => $request['url'],
            'hashtags' => $request['hashtags'],

        ]);
        return redirect('/');
    }

    public function get_post_detail($id, Article $article, Comment $comment)
    {

        $article = Article::find($id);
        $rows = Article::where('id', '=', $id)->first();

        $image = $this->image_checker($article['image']);
        $comments = Comment::where('post_id', "$id")->get();
        $post_sidebar = Article::where('user_id', $article['user_id'])->take(6)->orderBy('id', 'DESC')->get();
        $x = explode(",", $article['tags']);
        foreach ($x as $tagsx) {
            $tags[] = "<a class='button default small' href=\"/" .
                "hashtags/" . $this->url_slug($tagsx) . "\" style='margin: 2px'>$tagsx</a>";
        }
        return view('post', compact('article', 'image', 'comments', 'post_sidebar', 'tags'));
    }

    public function show_hashtags_results(Article $article, Request $request)
    {

        $term = $request->title;
        $string = str_replace('-', ' ', $term);

        $show_hashtags = Article::where('tags', 'LIKE', '%' . $string . '%')->orderBy('id', 'DESC')->paginate(15);
        $locale = session()->get('locale');
        if (!empty($locale)) {
            $random_article = Article::where('lang', $locale)->inRandomOrder()->take(20)->get();
        } else {
            $random_article = Article::inRandomOrder()->take(20)->get();
        }

        return view('hashtags', compact('show_hashtags', 'random_article'));
    }
    public function simple(Request $request)
    {
        if ($request->input('search')) {

            $clean = str_replace("-", " ", $request->search);
            $clean = str_replace("-", " ", $request->input('search'));
            $data = Article::where('tags', 'LIKE', "%" . $clean . "%")->orderBy('id', 'DESC');
        }
        if (empty($data)) {
            return redirect()->back();
        } else {
            $data = $data->paginate(10);
        }

        $locale = session()->get('locale');
        if (!empty($locale)) {
            $random_article = Article::where('lang', $locale)->inRandomOrder()->take(20)->get();
        } else {
            $random_article = Article::inRandomOrder()->take(20)->get();
        }
        return view('search', compact('data', 'random_article'));
    }
    public function submit_comment_no_user(Request $request)
    {



        return back()->with('error', trans('sentence.forSendcommentyoumustloginorregister'));
    }
    public function advance(Request $request)
    {
        if ($request->input('search')) {


            $data = Article::select('*')->where('title', 'LIKE', "%" . $request->search . "%")->orwhere('tags', 'LIKE', "%" . $request->search . "%")->orderBy('id', 'DESC');
        }

        $data = $data->paginate(10);



        $random_article = Article::inRandomOrder()->take(20)->get();

        return view('search', compact('data', 'random_article'));
    }
}
