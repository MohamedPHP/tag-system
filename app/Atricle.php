<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atricle extends Model
{
    protected $table = 'articles';

    public function tags() {
        return $this->belongsToMany('App\Tag', 'tag_links', 'article_id', 'tag_id');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'cat_id');
    }
}
