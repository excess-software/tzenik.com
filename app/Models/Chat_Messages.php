<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat_Messages extends Model
{
    protected $table = 'chat_messages';
    public $timestamps = true;
    public $fillable = ['id', 'chat_id', 'sender', 'message', 'created_at', 'updated_at'];

    public function chat(){
        return $this->belongsTo('App\Models\Chat_Chats', 'id');
    }
    public function message_owner(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
