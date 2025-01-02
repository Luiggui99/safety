<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['imagen', 'nombre', 'section_titulo', 'section_id', 'background', 'orden', 'activo'];

    public function section_items():HasMany
    {
        return $this->hasMany(SectionItem::class);
    }

    public function menu():BelongsTo
    {
        return $this->belongsTo(Menu::class, 'section_id');
    }
}
