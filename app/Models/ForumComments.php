<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumComments extends Model
{
    protected $table = 'tbl_forum_comments';
    protected $fillable = ['comment','user_id','email','create_at','update_at','name','post_id','parent','mode'];
    public $timestamps = false;

    public function post(){
        return $this->belongsTo('App\Models\Forum','post_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function childs(){
        return $this->hasMany('App\Models\ForumComments','parent');
    }
}
