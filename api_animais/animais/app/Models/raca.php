<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class raca extends Model
{
    protected $fillable = [
        'Nome_da_raca',
        'Tamanho',
        'idade',
    ];
    
}
