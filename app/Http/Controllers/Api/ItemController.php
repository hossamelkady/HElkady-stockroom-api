<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Item::query()->latest()->paginate(15));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'sku' => 'required|string|max:60|unique:items,sku',
            'name' => 'required|string|max:180',
            'quantity' => 'sometimes|integer|min:0',
            'reorder_level' => 'sometimes|integer|min:0',
            'unit_price' => 'sometimes|numeric|min:0'
        ]);

        $record = Item::create($data);
        return response()->json(['data' => $record], 201);
    }

    public function show(Item $item): JsonResponse
    {
        return response()->json(['data' => $item]);
    }

    public function update(Request $request, Item $item): JsonResponse
    {
        $data = $request->validate(['sku' => ['sometimes', 'string', 'max:60', \Illuminate\Validation\Rule::unique('items', 'sku')->ignore($item->id)], 'name' => 'sometimes|string|max:180', 'quantity' => 'sometimes|integer|min:0', 'reorder_level' => 'sometimes|integer|min:0', 'unit_price' => 'sometimes|numeric|min:0']);
        $item->update($data);
        return response()->json(['data' => $item->refresh()]);
    }

    public function destroy(Item $item): JsonResponse
    {
        $item->delete();
        return response()->json([], 204);
    }
}
