<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['texto_principal', 'texto_secundario', 'imagen_url', 'imagen_alt', 'boton_texto', 'boton_icono', 'boton_url', 'activo'];

}
