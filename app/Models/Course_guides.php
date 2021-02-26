<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course_guides extends Model
{
    protected $table = 'content_guides';
    public $fillable = ['content_id', 'initial_date', 'final_date', 'route'];
    public $timestamps = false;
}
