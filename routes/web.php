<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;

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
});


require __DIR__.'/auth.php';
