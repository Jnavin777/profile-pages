<?php

use Illuminate\Support\Facades\Route;
use Profiles\ProfileController;

Route::middleware(['web','auth'])->group(function () {
    Route::post('/profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile.show');
    Route::get('/my-profile', [ProfileController::class, 'myProfile'])->name('profile.my-show');
});
