<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'ArticlesController@get_all');
Route::get('/robots/{id}', 'RobotsController@get_content');

Route::get('/p/{id}', 'ArticlesController@get_post_detail');
Route::get('/pages/{page}', 'PagesContoller@get_page_detail');
Route::get('/product/{id}', 'ProductsController@get_product_detail');
Route::get('/shop', 'ProductsController@get_all');
Route::get('/blog', 'ArticlesController@get_all_posts');

Route::get('/hashtags/{title}', 'ArticlesController@show_hashtags_results');

Route::get('/archive', 'ArticlesController@simple')->name('simple_search');
Route::get('/u/{user}', 'UsersController@show');
Route::get('/weather/{city?}', 'WeatherController@showWeather');
Route::post('/articles/submit_comment_no_user', 'ArticlesController@submit_comment_no_user');
Route::get('/search', 'ArticlesController@advance');



Route::get('ajaxRequest', 'AjaxController@ajaxRequest');
Route::post('ajaxRequest', 'AjaxController@ajaxRequestPost')->name('ajaxRequest.post');



Route::post('/admin/add_settingx', 'AdminController@add_setting');


Auth::routes();
Route::get('/google-login', 'GoogleAuthController@redirectToProvider');
Route::get('/callback', 'GoogleAuthController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/wall', 'HomeController@wall');
Route::get('/special_post', 'HomeController@special_post');
Route::post('/special_post', 'HomeController@submit_special_post');
Route::get('/setting', 'HomeController@user_setting');
Route::get('/flolow_setting', 'HomeController@flolow_setting');
Route::get('/articles/add', 'HomeController@view_form_article');
Route::post('/articles/submit_articles', 'HomeController@submit_form_article');
Route::post('/articles/submit_comment', 'HomeController@send_comment');
Route::post('/reaction', 'HomeController@post_reaction');
Route::get('/{locale}', 'ArticlesController@lang');
Route::get('/user_hashtags', 'HomeController@get_user_hashtags');
Route::patch('/user_update_setting/{user_id}', 'HomeController@user_update_setting');
Route::patch('/user_update_avatar/{user_id}', 'HomeController@user_update_avatar');


//Home//
Route::get('/home/twitter/', 'HomeController@show_twitter_wall');
Route::get('/home/instagram/', 'HomeController@show_instagram_wall');
Route::get('/home/facebook/', 'HomeController@show_facebook_wall');
Route::get('/home/youtube/', 'HomeController@show_youtube_wall');
Route::get('/home/flickr/', 'HomeController@show_flicker_wall');





//admin//


Route::get('admin/home', 'AdminController@adminHome')->name('admin.home')->middleware('is_admin');
//Posts//
Route::get('admin/posts/add_new_post', 'AdminController@add_new_post')->middleware('is_admin');
Route::post('admin/posts/add_new_post', 'AdminController@submit_new_post')->middleware('is_admin');
Route::get('/admin/posts/show_all_posts', 'AdminController@show_all_posts')->middleware('is_admin');
Route::get('/admin/posts/edit_post/{id}', 'AdminController@get_edit_byid')->middleware('is_admin');
Route::patch('/admin/posts/edit_post/{id}', 'AdminController@update_post_byid')->middleware('is_admin');
Route::get('/admin/posts/delete_post/{id}', 'AdminController@deleted_post_byid')->middleware('is_admin');
Route::get('/admin/posts/add_new_category', 'AdminController@add_new_category')->middleware('is_admin');
Route::post('/admin/posts/add_new_category', 'AdminController@submit_new_category')->middleware('is_admin');
Route::get('/admin/posts/show_all_categories', 'AdminController@show_all_categories')->middleware('is_admin');
Route::get('/admin/posts/delete_category/{id}', 'AdminController@deleted_category_byid')->middleware('is_admin');
Route::get('/admin/posts/edit_category/{id}', 'AdminController@get_category_edit_byid')->middleware('is_admin');
Route::patch('/admin/posts/edit_category/{id}', 'AdminController@update_category_byid')->middleware('is_admin');
//Producs//
Route::get('/admin/products/add_new_product', 'AdminController@add_new_product')->middleware('is_admin');
Route::post('/admin/products/add_new_product', 'AdminController@submit_new_product')->middleware('is_admin');
Route::get('/admin/products/show_all_products', 'AdminController@show_all_products')->middleware('is_admin');
Route::get('/admin/products/edit_product/{id}', 'AdminController@get_edit_byid')->middleware('is_admin');
Route::patch('/admin/products/edit_product/{id}', 'AdminController@update_product_byid')->middleware('is_admin');
Route::get('/admin/products/delete_product/{id}', 'AdminController@deleted_product_byid')->middleware('is_admin');
Route::get('/admin/products/add_new_category', 'AdminController@add_new_category')->middleware('is_admin');
Route::post('/admin/products/add_new_category', 'AdminController@submit_new_category')->middleware('is_admin');
Route::get('/admin/products/show_all_categories', 'AdminController@show_all_categories')->middleware('is_admin');
Route::get('/admin/products/delete_category/{id}', 'AdminController@deleted_category_byid')->middleware('is_admin');
Route::get('/admin/products/edit_category/{id}', 'AdminController@get_category_edit_byid')->middleware('is_admin');
Route::patch('/admin/products/edit_category/{id}', 'AdminController@update_category_byid')->middleware('is_admin');
Route::get('/admin/products/add_new_attribute', 'AdminController@add_new_attribute')->middleware('is_admin');
Route::post('/admin/products/add_new_attribute', 'AdminController@submit_new_attribute')->middleware('is_admin');
Route::get('/admin/products/show_all_attributes', 'AdminController@show_all_attributes')->middleware('is_admin');
Route::get('/admin/products/edit_attribute/{id}', 'AdminController@get_edit_attribute_byid')->middleware('is_admin');
Route::patch('/admin/products/edit_attribute/{id}', 'AdminController@update_attribute_byid')->middleware('is_admin');
Route::get('/admin/products/delete_attribute/{id}', 'AdminController@deleted_attribute_byid')->middleware('is_admin');
//Menus//
Route::get('admin/menus/add_new_menu', 'AdminController@add_new_menu')->middleware('is_admin');
Route::post('admin/menus/add_new_menu', 'AdminController@submit_new_menu')->middleware('is_admin');
Route::get('/admin/menus/show_all', 'AdminController@show_all_menus')->middleware('is_admin');
Route::get('/admin/menus/edit_menu/{id}', 'AdminController@menu_edit_byid')->middleware('is_admin');
Route::patch('/admin/update_menus_byid/{id}', 'AdminController@update_menu_byid')->middleware('is_admin');
Route::get('/admin/menus/delete_post/{id}', 'AdminController@deleted_post_byid')->middleware('is_admin');
//Pages//
Route::get('admin/pages/add_new_page', 'AdminController@add_new_page')->middleware('is_admin');
Route::post('admin/pages/add_new_page', 'AdminController@submit_new_page')->middleware('is_admin');
Route::get('/admin/pages/show_all', 'AdminController@show_all_pages')->middleware('is_admin');
Route::get('/admin/pages/edit_page/{id}', 'AdminController@page_edit_byid')->middleware('is_admin');
Route::patch('/admin/update_pages_byid/{id}', 'AdminController@update_page_byid')->middleware('is_admin');
Route::get('/admin/pages/delete_page/{id}', 'AdminController@deleted_pages_byid')->middleware('is_admin');
//Other//
Route::get('/admin/setting', 'AdminController@show_setting')->middleware('is_admin');
Route::get('/admin/add_setting', 'AdminController@add_setting_form');
