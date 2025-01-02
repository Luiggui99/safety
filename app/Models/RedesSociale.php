<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedesSociale extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'url', 'icono', 'activo'];
}
