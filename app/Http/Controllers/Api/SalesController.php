<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleCollection;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user', 'book')->paginate(10);
        return new SaleCollection($sales);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idBook' => 'required|exists:books,id',
            'idUser' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required',
        ]);

        $sale = Sale::create($validatedData);

        return response()->json(['message' => 'Ventra creada con éxito', 'data' => $sale]);
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);

        $validatedData = $request->validate([
            'idBook' => 'required|exists:books,id',
            'idUser' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required',
        ]);

        $sale->update($validatedData);

        return response()->json(['message' => 'Venta actualizada con éxito', 'data' => $sale]);
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return response()->json(['message' => 'Venta eliminada con éxito']);
    }
}
