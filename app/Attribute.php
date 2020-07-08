<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'attribute_title',
        'attribute_price',
        'image',
        'lang',
    ];
    protected $dates = ['deleted_at'];
}
