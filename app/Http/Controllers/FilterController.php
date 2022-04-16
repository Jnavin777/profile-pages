<?php

namespace App\Http\Controllers;

use App\Enum\ConditionEnum;
use App\Models\Branch;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class FilterController extends Controller
{
    public function makeFilter(string $name)
    {
        $filterName = 'filter'.ucfirst($name);
        $filterOptions = $this->$filterName();

        return new JsonResponse(['data' => $filterOptions], Response::HTTP_OK);
    }

    private function filterBranch()
    {
        return Branch::select(['id as value', 'name as text'])->where(['user_id' => Auth::id()])->get()->toArray();
    }

    private function filterCondition()
    {
        return ConditionEnum::$filterArray;
    }

    private function filterCategory()
    {
        return Category::select(['id as value', 'name as text'])->where(['user_id' => Auth::id()])->get()->toArray();
    }

    private function filterRole()
    {
        return Role::select(['id as value', 'name as text'])->get()->toArray();
    }
}
