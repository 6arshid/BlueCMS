<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'url',
        'tags',
        'image',
        'post_type',
    ];
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
