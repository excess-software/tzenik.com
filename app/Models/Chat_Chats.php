<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat_Chats extends Model
{
    protected $table = 'chat_chats';
    public $fillable = ['id', 'creator', 'name', 'published'];
    public $timestamps = false;

    public function owner(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function users_in_chat(){
        return $this->hasMany('App\Models\Chat_UsersInChat', 'chat_id');
    }
    public function messages(){
        return $this->hasMany('App\Models\Chat_Messages', 'id');
    }
}
