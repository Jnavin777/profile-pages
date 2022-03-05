<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $newItem->inventory_id = $request->get('inventory_id');
        $newItem->category_id = $request->get('category_id');
//        $newItem->branch_id = $request->get('branch_id');
        $newItem->date_of_receiving = $request->get('date_of_receiving');
        $newItem->save();
        return new JsonResponse($newItem, Response::HTTP_OK);
    }

    public function getItemsByInventory(Inventory $inventory)
    {
        return new JsonResponse([
            'items' => Item::where(['inventory_id' => $inventory])->get()
        ], Response::HTTP_OK);
    }
}
