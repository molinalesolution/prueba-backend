<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['divisa', 'precios.divisa'])->paginate(15);
        return response()->json($productos, 200);
    }

    public function store(StoreProductoRequest $request)
    {
        $producto = Producto::create($request->validated());
        return response()->json($producto->load(['divisa', 'precios.divisa']), 201);
    }

    public function show($id)
    {
        $producto = Producto::with(['divisa', 'precios.divisa'])->findOrFail($id);
        return response()->json($producto, 200);
    }

    public function update(UpdateProductoRequest $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->validated());
        return response()->json($producto->load(['divisa', 'precios.divisa']), 200);
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado correctamente'], 200);
    }
}