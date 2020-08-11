<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat_UsersInChat extends Model
{
    protected $table = 'chat_users_in_chat';
    public $fillable = ['id', 'chat_id', 'user_id'];

    public function chat_details(){
        return $this->belongsTo('App\Models\Chat_Chats', 'id');
    }
    public function users(){
        return $this->hasMany('App\User', 'user_id');
    }
}
