<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChildController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/child/create', [ChildController::class, 'create'])->name('child.create');
Route::post('/child/store', [ChildController::class, 'store'])->name('child.store');
Route::get('child/thank_you', function () { return view('child.thankyou');})->name('child.thankyou');

