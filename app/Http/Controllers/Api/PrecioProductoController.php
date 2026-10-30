<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Http\Requests\StorePrecioProductoRequest;

class PrecioProductoController extends Controller
{
    public function index($id)
    {
        $producto = Producto::findOrFail($id);
        $precios = $producto->precios()->with('divisa')->get();
        
        return response()->json($precios, 200);
    }

    public function store(StorePrecioProductoRequest $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $precio = $producto->precios()->updateOrCreate(
            ['currency_id' => $request->currency_id],
            ['price' => $request->price]
        );

        return response()->json($precio->load('divisa'), 201);
    }
}