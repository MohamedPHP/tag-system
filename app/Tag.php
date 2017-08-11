<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function articles() {
        return $this->belongsToMany('App\Atricle', 'tag_links', 'article_id', 'tag_id');
    }
}
