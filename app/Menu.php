<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'parent_id',
        'url',
        'color',
        'lang'
    ];
    protected $dates = ['deleted_at'];

    public function scopeGetBySlug($query, $slug){
        return $query->where('tags', 'LIKE', '%' . $slug . '%')->first();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
