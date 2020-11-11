<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    protected $table = 'tbl_forum_category';
    public $timestamps = false;
    public $fillable = ['product_id', 'title', 'desc', 'published', 'type'];

    public function posts(){
        return $this->hasMany('App\Models\Forum','category_id');
    }
}
