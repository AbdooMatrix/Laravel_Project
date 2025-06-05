<?php

use App\Http\Controllers\OurUsersController;
use Illuminate\Support\Facades\Route;




Route::get('/about', function () { return view('about'); });


Route::get('/', [OurUsersController::class, 'create'])->name('users.create');
Route::post('/', [OurUsersController::class, 'store'])->name('users.store');


