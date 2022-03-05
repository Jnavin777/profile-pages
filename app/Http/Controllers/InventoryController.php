<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InventoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('inventories.index');
    }

    public function getItems()
    {
        return new JsonResponse([
            'inventories' => Inventory::where(['user_id' => Auth::id()])->with('user')->get()
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $newInventory = new Inventory();
        $newInventory->name = $request->get('name');
        $newInventory->description = $request->get('description');
        $newInventory->user_id = Auth::id();
        $newInventory->save();
        return new JsonResponse($newInventory, Response::HTTP_OK);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        return view('inventories.show', [
            'item' => Inventory::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $inventory = Inventory::whereId($id)->first();
        $inventory->name = $request->get('name');
        $inventory->description = $request->get('description');
        $inventory->user_id = Auth::id();
        $inventory->save();
        return new JsonResponse($inventory, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $inventory = Inventory::find($id);
        $inventory->delete();
        return new JsonResponse([], Response::HTTP_OK);
    }
}
