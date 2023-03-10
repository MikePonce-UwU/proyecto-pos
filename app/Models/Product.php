<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nombre', 'descripcion', 'cantidad', 'precio_anterior', 'precio_sin_iva', 'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(related: Category::class);
    }
}
