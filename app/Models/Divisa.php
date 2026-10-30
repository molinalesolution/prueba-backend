<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisa extends Model
{
    protected $table = 'divisas';

    protected $fillable = [
        'name',
        'symbol',
        'exchange_rate',
    ];

    // Una divisa puede estar asociada a muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'currency_id');
    }

    // Una divisa puede estar en muchos precios de productos
    public function precios()
    {
        return $this->hasMany(PrecioProducto::class, 'currency_id');
    }
}
