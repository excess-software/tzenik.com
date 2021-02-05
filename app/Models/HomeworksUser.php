<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeworksUser extends Model
{
    protected $table = 'homeworks_user';
    public $fillable = ['user_id', 'content_id', 'part_id', 'route', 'viewed'];
    public $timestamps = false;
}
