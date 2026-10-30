<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency_id',
        'tax_cost',
        'manufacturing_cost',
    ];

    // Un producto pertenece a una divisa base
    public function divisa()
    {
        return $this->belongsTo(Divisa::class, 'currency_id');
    }

    // Un producto tiene múltiples precios en diferentes divisas
    public function precios()
    {
        return $this->hasMany(PrecioProducto::class, 'product_id');
    }
}
