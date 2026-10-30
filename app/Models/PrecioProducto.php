<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioProducto extends Model
{
    protected $table = 'precios_productos';

    protected $fillable = [
        'product_id',
        'currency_id',
        'price',
    ];

    // Pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'product_id');
    }

    // Pertenece a una divisa
    public function divisa()
    {
        return $this->belongsTo(Divisa::class, 'currency_id');
    }
}
