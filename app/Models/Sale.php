<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'cliente_nombre',
        'cliente_cedula',
        'cliente_telefono',
        'user_id',
        'total_venta',
    ];

    public function products(): BelongsToMany{
        return $this->belongsToMany(related: Product::class)->withPivot(columns: ['cantidad']);
    }
    public function user(): BelongsTo{
        return $this->belongsTo(related: User::class);
    }
}
