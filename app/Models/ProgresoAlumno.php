<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgresoAlumno extends Model
{
    protected $table = 'progreso_alumnos';
    public $fillable = ['user_id', 'content_id', 'part_id', 'date', 'time'];
    public $timestamps = false;
}
