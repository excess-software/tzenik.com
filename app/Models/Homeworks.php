<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homeworks extends Model
{
    protected $table = 'homeworks';
    public $fillable = ['content_id', 'part_id', 'title', 'description'];
    public $timestamps = false;
}
