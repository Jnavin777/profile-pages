<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('branches.index');
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
        $newBranch = new Branch();
        $newBranch->name = $request->get('name');
        $newBranch->user_id = Auth::id();
        $newBranch->save();
        return new JsonResponse($newBranch, Response::HTTP_OK);
    }

    /**
     * @param Branch $branch
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * @param Branch $branch
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * @param Request $request
     * @param Branch $branch
     * @return JsonResponse
     */
    public function update(Request $request, Branch $branch)
    {
        $branch->name = $request->get('name');
        $branch->save();
        return new JsonResponse($branch, Response::HTTP_OK);
    }

    /**
     * @param Branch $branch
     * @return JsonResponse
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return new JsonResponse([], Response::HTTP_OK);
    }

    public function getItems()
    {
        return new JsonResponse([
            'branches' => Branch::where(['user_id' =>Auth::id()])->with('user')->get()
        ], Response::HTTP_OK);
    }
}
