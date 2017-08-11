<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagLink extends Model
{
    public function articles() {
        return $this->hasMany('App\Atricle', 'article_id');
    }

    public function tags() {
        return $this->hasMany('App\Tag', 'tag_id');
    }
}
