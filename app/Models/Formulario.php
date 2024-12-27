<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'placeholder', 'identificador', 'requerido', 'tipo', 'tipo_campo', 'orden', 'activo'];
}
