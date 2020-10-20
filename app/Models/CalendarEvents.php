<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEvents extends Model
{
    protected $table = 'eventos_usuario';
    public $fillable = ['user_id', 'product_id', 'date', 'type', 'content'];
    public $timestamps = false;
}
