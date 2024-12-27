<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SectionItem extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'titulo', 'section_background', 'descripcion', 'contenido', 'imagen', 'boton_nombre', 'boton_color', 'boton_icon', 'boton_url', 'activo'];

    public function section():BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
