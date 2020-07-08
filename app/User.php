<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;    // Must Must use
use Illuminate\Support\Facades\Blade;   // Must Must use
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','language','instagram','facebook','twitter','youtube','publicemail',
        'siteurl','instagram_follow_tags','facebook_follow_tags','twitter_follow_tags','youtube_follow_tags','yt_playlist',
        'yt_chid','yt_keywords','fb_groupname','instagram_user_name','twitter_hashtag','user_name','city','gender',
        'age','marital_status','country','state','status','cover','about', 'is_admin','complete_the_profile','flicker_keyword', 'flicker_username',
        'site_feeds','google_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getRouteKeyName()
    {
        return 'user_name';
    }
    public function article(){
        return $this->hasMany(Article::class)->latest();
    }
    
    public function comment(){
        return $this->hasMany(Comment::class);
    }
    
  
}
