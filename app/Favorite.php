<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'url',
        'favicon',
        'title',
        'meta_description',
        'meta_keywords'
    ];
}
