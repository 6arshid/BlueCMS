<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function show(User $user)
    {
        return view('auth.u', [
            'profileUser' => $user,
            'threads' => $user->article()->orderBy('id', 'DESC')->paginate(10),
        ]);
    }
   
    public function test_profiles_display_all_threads_by_the_user()
    {
        $user = create('App\User');

        $thread = create('App\Article', ['user_id' => $user->id]);

        $this->withoutExceptionHandling()->get('/u/' . $user->name)
            ->assertSee($thread->title)
            ->assertSee($thread->content);
    }

    // public function get_user_profile(User $user)
    // {
  
    //     return view('auth.u', [
    //         'profileUser' => $user,
    //         'article' => $user->article()->paginate(10)
    //     ]);

    // }
    // public function test_profiles_display_all_article_by_the_user()
    // {
    //     $user = create('App\User');

    //     $article = create(Article::class, ['user_id' => $user->id]);

    //     $this->withoutExceptionHandling()->get('/u/' . $user->name)
    //         ->assertSee($article->title)
    //         ->assertSee($article->content);
    // }
}
