<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppTokens extends Model
{
    protected $table = 'app_tokens';
    public $fillable = ['user_id', 'token', 'status'];
    public $timestamps = true;
}
