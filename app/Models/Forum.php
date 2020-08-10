<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'tbl_forum_posts';
    public $fillable = ['title','pre_content','content','category_id','create_at','update_at','tags','image','user_id','comments','mode'];
    public $timestamps = false;

    public function comments(){
        return $this->hasMany('App\Models\ForumComments','post_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function category(){
        return $this->belongsTo('App\Models\ForumCategory','category_id');
    }
}
