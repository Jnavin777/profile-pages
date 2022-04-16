<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function index()
    {

//        $user = User::find(1);
//
//        $user->assignRole(['Super Admin', 'Member']);
//        $user->givePermissionTo('edit inventories');
//        dd($user->getPermissionNames());
        return view('dashboard');
    }
}
