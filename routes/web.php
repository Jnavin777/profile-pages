<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BranchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/inventory', [InventoryController::class,'index'])->name('inventory.index');
    Route::post('/inventory', [InventoryController::class,'store'])->name('inventory.store');
    Route::patch('/inventory/{id}', [InventoryController::class,'update'])->name('inventory.update');
    Route::delete('/inventory/{id}', [InventoryController::class,'destroy'])->name('inventory.destroy');
    Route::get('/inventory/get_items', [InventoryController::class,'getItems'])->name('inventory.get-items');
    Route::get('/inventory/{id}', [InventoryController::class,'show'])->name('inventory.show');
    Route::get('/category/get_item', [CategoryController::class,'getItems'])->name('category.get-items');
    Route::resource('/category', CategoryController::class);
    Route::get('/branch/get_item', [BranchController::class,'getItems'])->name('branch.get-items');
    Route::get('/branch/{id}/inventories', [BranchController::class,'getInventories'])->name('branch.getInventories');
    Route::resource('/branch', BranchController::class);
    Route::resource('/item', ItemController::class);
    Route::post('/item', [ItemController::class, 'store'])->name('item.store');;
    Route::patch('/item/{id}', [ItemController::class,'update'])->name('item.update');
    Route::post('/item', [ItemController::class,'store'])->name('item.store');
    Route::get('/inventory/{inventory}/get_item', [ItemController::class,'getItemsByInventory'])->name('category.get-items-by-inventory');

});


require __DIR__.'/auth.php';


/**
 * Teamwork routes
 */
Route::group(['prefix' => 'teams', 'namespace' => 'Teamwork'], function()
{
    Route::get('/', [App\Http\Controllers\Teamwork\TeamController::class, 'index'])->name('teams.index');
    Route::get('create', [App\Http\Controllers\Teamwork\TeamController::class, 'create'])->name('teams.create');
    Route::post('teams', [App\Http\Controllers\Teamwork\TeamController::class, 'store'])->name('teams.store');
    Route::get('edit/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'edit'])->name('teams.edit');
    Route::put('edit/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'update'])->name('teams.update');
    Route::delete('destroy/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'destroy'])->name('teams.destroy');
    Route::get('switch/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'switchTeam'])->name('teams.switch');

    Route::get('members/{id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'show'])->name('teams.members.show');
    Route::get('members/resend/{invite_id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'resendInvite'])->name('teams.members.resend_invite');
    Route::post('members/{id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'invite'])->name('teams.members.invite');
    Route::delete('members/{id}/{user_id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'destroy'])->name('teams.members.destroy');

    Route::get('accept/{token}', [App\Http\Controllers\Teamwork\AuthController::class, 'acceptInvite'])->name('teams.accept_invite');
});
