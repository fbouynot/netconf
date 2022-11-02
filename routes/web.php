<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

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

Route::get('/', function() { return redirect()->route('indexNewVlan'); });
Route::get('/polflex', [IndexController::class, 'indexPolflex'])->name('indexPolflex');
Route::post('/polflex', [IndexController::class, 'configPolflex'])->name('configPolflex');
Route::get('/newvlan', [IndexController::class, 'indexNewVlan'])->name('indexNewVlan');
Route::post('/newvlan', [IndexController::class, 'configNewVlan'])->name('configNewVlan');