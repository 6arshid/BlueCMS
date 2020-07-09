<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'title',
        'description',
        'site_url',
        'tags',
        'email_send',
        'email_received',
        'lang',
    ];
}
