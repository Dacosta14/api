<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alimentacao extends Model
{
    protected $table = 'alimentacao';

    protected $fillable = [
        'quantiadade',
        'horario_alimentacao',
        'tipo_racao',
    ];
}
