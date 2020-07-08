<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'url',
        'tags',
        'image',
        'lang',
        'feed_source',
        'categories',
    ];
    protected $dates = ['deleted_at'];
    public function getRouteKeyName()
    {
        return 'title';
    }
    public function scopeGetBySlug($query, $slug){
        return $query->where('tags', 'LIKE', '%' . $slug . '%')->first();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
