<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index');
    }

    /**
     *
     */
    public function create()
    {
//
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $newCategory = new Category();
        $newCategory->name = $request->get('name');
        $newCategory->user_id = Auth::id();
        $newCategory->save();
        return new JsonResponse($newCategory, Response::HTTP_OK);
    }

    /**
     * @param Category $category
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * @param Category $category
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->get('name');
        $category->save();
        return new JsonResponse($category, Response::HTTP_OK);
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return new JsonResponse([], Response::HTTP_OK);
    }

    public function getItems()
    {
        return new JsonResponse([
            'categories' => Category::where(['user_id' =>Auth::id()])->with('user')->get()
        ], Response::HTTP_OK);
    }
}
