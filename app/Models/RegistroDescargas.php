<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroDescargas extends Model
{
    protected $table = 'registro_descargas';
    public $fillable = ['user_id', 'content_id'];
    public $timestamps = false;
}
