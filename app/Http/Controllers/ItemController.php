<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        $newItem = new Item();
        $newItem->name = $request->get('name');
        $newItem->condition = $request->get('condition');
        $newItem->article = $request->get('article');
        $newItem->inventory_id = $request->get('inventoryId');
        $newItem->category_id = $request->get('categoryId');
//        $newItem->branch_id = $request->get('branchId');
        $newItem->date_of_receiving = $request->get('dateOfReceiving');
        $newItem->save();
        return new JsonResponse($newItem, Response::HTTP_OK);
    }

    public function update(Request $request, int $id)
    {
        $item = Item::whereId($id)->first();
        $item->name = $request->get('name');
        $item->condition = $request->get('condition');
        $item->article = $request->get('article');
        $item->inventory_id = $request->get('inventoryId');
        $item->category_id = $request->get('categoryId');
//        $item->branch_id = $request->get('branchId');
        $item->date_of_receiving = $request->get('dateOfReceiving');
        $item->save();
        return new JsonResponse($item, Response::HTTP_OK);
    }

    public function getItemsByInventory(Inventory $inventory)
    {
        return new JsonResponse([
            'items' => Item::where(['inventory_id' => $inventory->id])->with('category')->get()
        ], Response::HTTP_OK);
    }
}
