<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Attribute;
use App\Product;
use App\Menu;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Routing\Controller;


class AdminController extends Controller
{
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
    public function adminHome()
    {
        return view('admin.adminHome');
    }
    public function add_new_post(Category $Category)
    {
        $categories =  Category::get();

        return view('admin.posts.add_new_post', compact('categories'));
    }
    public function submit_new_post(Request $request, Auth $controller, Article $article)
    {

        $user = auth()->user();
        $user_id = $user->id;

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:9048',
        ]);

        if ($request->hasfile('image')) {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(1200, 630)->save(public_path('uploads/images/' . $filename));
            $img_address = $filename;
        }
        $data = Article::create([
            'title' => $request['title'],
            'tags' => $request['tags'],
            'url' => 'no_url',
            'content' => $request['content'],
            'user_id' => $user_id,
            'image' => $img_address,
            'lang' => $request['lang'],
            'categories' => $request['categories'],

        ]);

        $id = $data->id;
        $mkurl = $this->url_slug($request['title']);
        $show_article = "/p/" . $id ."/".$mkurl;


        return redirect("$show_article");
    }
    public function show_all_posts(Request $request)
    {

        $article =  Article::orderBy('id', 'DESC')->paginate(10);
        return view('admin.posts.show_all', compact('article'));
    }
    public function get_edit_byid($id, Article $article)
    {
        $article = Article::find($id);
        return view('admin.posts.edit_post', compact('article'));
    }
    public function update_post_byid($id, Article $article, Request $request)
    {




        $rows = Article::where('id', '=', $id)->first();

        $rows->update($request->all());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        // $data = app('request');
        if ($request->hasfile('image')) {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('uploads/images/' . $filename));
            $rows = Article::where('id', '=', $id)->first();
            $rows->update(array($request->all()));
            Article::where('id', '=', $id)->update(array('image' => $filename));
        }
        return back()->with('success', 'your post updated !');
    }
    public function deleted_post_byid($id)
    {
        Article::where('id', '=', $id)->delete();
        return redirect('/admin/posts/show_all_posts')->with('success', 'your post deleted !');
    }
    public function add_new_category()
    {
        return view('admin.posts.add_new_category');
    }
    public function submit_new_category(Request $request, Auth $controller, Category $Category)
    {

        $user = auth()->user();
        $user_id = $user->id;

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        if ($request->hasfile('image')) {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(1024, 768)->save(public_path('/uploads/images/' . $filename));
        }
        $data = Category::create([
            'title' => $request['title'],
            'tags' => $request['tags'],
            'url' => $request['url'],
            'image' => $filename,
            'post_type' => 'post'
        ]);


        return back()->with('success', 'your category added !');
    }
    public function show_all_categories(Request $request)
    {

        $category =  Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.posts.show_all_categories', compact('category'));
    }
    public function deleted_category_byid($id)
    {
        Category::where('id', '=', $id)->delete();
        return redirect('/admin/posts/show_all_categories')->with('success', 'your category deleted !');
    }
    public function get_category_edit_byid($id, Category $Category)
    {
        $category = Category::where('id', '=', $id)->first();
        return view('admin.posts.edit_category', compact('category'));
    }
    public function update_category_byid($id, Category $Category, Request $request)
    {




        $rows = Category::where('id', '=', $id)->first();

        $rows->update($request->all());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        // $data = app('request');
        if ($request->hasfile('image')) {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('uploads/images/' . $filename));
            $rows = Category::where('id', '=', $id)->first();
            $rows->update(array($request->all()));
            Category::where('id', '=', $id)->update(array('image' => $filename));
        }
        return back()->with('success', 'your category updated !');
    }
    public function add_new_product(Category $Category)
    {
        $categories =  Category::get();
        $attributes =  Attribute::get();

        return view('admin.products.add_new_product', compact('categories', 'attributes'));
    }
    public function add_new_attribute()
    {
        return view('admin.products.add_new_attribute');
    }
    public function submit_new_attribute(Request $request, Attribute $attribute)
    {



        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        if ($request->hasfile('image')) {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(1024, 768)->save(public_path('/uploads/images/' . $filename));
        } else {
            $filename = "no-image";
        }
        $data = Attribute::create([
            'attribute_title' => $request['attribute_title'],
            'attribute_price' => $request['attribute_price'],
            'image' => $filename,
            'lang' => $request['lang'],

        ]);

        $last_id = $data->id;

        return redirect("/admin/products/show_all_attributes");
    }
    public function show_all_attributes(Request $request)
    {

        $attributes =  Attribute::orderBy('id', 'DESC')->paginate(10);
        return view('admin.products.show_all_attributes', compact('attributes'));
    }
    public function submit_new_product(Request $request, Auth $controller, Category $Category)
    {

        $user = auth()->user();
        $user_id = $user->id;

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:9048',
        ]);

        if ($request->hasfile('image')) {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(1280, 720)->save(public_path('/uploads/images/' . $filename));
        }
        $data = Product::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'tags' => $request['tags'],
            'lang' => $request['lang'],
            'categories' => $request['categories'],
            'url' => $request['url'],
            'image' => $filename,
            'attribute' => $request['attribute'],
            'user_id' => $user_id

        ]);
        $last_id = $data->id;

        $show_article = "/product/" . $last_id;
        return redirect("$show_article")->with('success', 'your product added !');

        // return back()->with('success', 'your product added !' );
    }
    public function show_all_products(Request $request)
    {

        $article =  Product::orderBy('id', 'DESC')->paginate(10);
        return view('admin.products.show_all', compact('article'));
    }
    public function add_new_menu()
    {


        return view('admin.menus.add_new_menu');
    }
    public function submit_new_menu(Request $request, Auth $controller, Menu $menu)
    {

        $user = auth()->user();
        $user_id = $user->id;



        // if ($request->hasfile('image')) {
        //     $avatar = $request->file('image');
        //     $filename = time() . '.' . $avatar->getClientOriginalExtension();
        //     Image::make($avatar)->resize(1200, 630)->save(public_path('uploads/images/' . $filename));
        //     $img_address = $filename;
        // }
        $data = Menu::create([
            'title' => $request['title'],
            'url' =>  $request['url'],
            'parrent_id' => $request['parrent_id'],
            'color' => $request['color'],
            'lang' => $request['lang'],
            'icon' => $request['icon'],

        ]);
        $msg = "Your menu added click here fo show";

        return back()->with('success', $msg);
    }
    public function show_all_menus(Request $request)
    {

        $menus =  Menu::orderBy('id', 'DESC')->paginate(10);
        return view('admin.menus.show_all', compact('menus'));
    }
    public function menu_edit_byid($id, Menu $menu)
    {
        $menu = Menu::find($id);
        return view('admin.menus.edit_menu', compact('menu'));
    }
    public function update_menu_byid($id, Menu $Menu, Request $request)
    {




        $rows = Menu::where('id', '=', $id)->first();

        $rows->update($request->all());


        $rows->update(array($request->all()));

        return back()->with('success', 'your menu updated !');
    }
    public function deleted_menu_byid($id)
    {
        Menu::where('id', '=', $id)->delete();
        return redirect('/admin/menus/show_all_menus')->with('success', 'your post deleted !');
    }

    public function add_new_page()
    {


        return view('admin.pages.add_new_page');
    }
    public function submit_new_page(Request $request, Auth $controller, page $page)
    {

        $user = auth()->user();
        $user_id = $user->id;



        // if ($request->hasfile('image')) {
        //     $avatar = $request->file('image');
        //     $filename = time() . '.' . $avatar->getClientOriginalExtension();
        //     Image::make($avatar)->resize(1200, 630)->save(public_path('uploads/images/' . $filename));
        //     $img_address = $filename;
        // }
        $data = page::create([
            'title' => $request['title'],
            'url' =>  $request['url'],
            'parrent_id' => $request['parrent_id'],
            'color' => $request['color'],
            'lang' => $request['lang'],
            'icon' => $request['icon'],

        ]);
        $msg = "Your page added click here fo show";

        return back()->with('success', $msg);
    }
    public function show_all_pages(Request $request)
    {

        $pages =  page::orderBy('id', 'DESC')->paginate(10);
        return view('admin.pages.show_all', compact('pages'));
    }
    public function page_edit_byid($id, page $page)
    {
        $page = page::find($id);
        return view('admin.pages.edit_page', compact('page'));
    }
    public function update_page_byid($id, page $page, Request $request)
    {




        $rows = page::where('id', '=', $id)->first();

        $rows->update($request->all());


        $rows->update(array($request->all()));

        return back()->with('success', 'your page updated !');
    }
    public function deleted_page_byid($id)
    {
        page::where('id', '=', $id)->delete();
        return redirect('/admin/pages/show_all_pages')->with('success', 'your post deleted !');
    }
}
