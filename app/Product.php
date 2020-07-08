<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'price',
        'tags',
        'image',
        'lang',
        'attribute',
        'categories',
    ];
    protected $dates = ['deleted_at'];
    public function scopeGetBySlug($query, $slug){
        return $query->where('tags', 'LIKE', '%' . $slug . '%')->first();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
