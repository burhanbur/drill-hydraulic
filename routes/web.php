<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\EquivalentCirculatingController;
use App\Http\Controllers\FlowrateMinimumController;
use App\Http\Controllers\PressureLossController;
use App\Http\Controllers\RheologicalController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('store', [HomeController::class, 'index'])->name('store.ecd');
Route::get('ajax-combination', [HomeController::class, 'ajaxCombination'])->name('ajax.combination');
Route::get('ajax-output-surface', [HomeController::class, 'ajaxOutputSurfaceEquipment'])->name('ajax.output.surface');


Route::group(['prefix' => 'drill-hydraulic'], function () {
	Route::post('ecd', [HomeController::class, 'ecd'])->name('ecd');
	Route::get('rheological', [RheologicalController::class, 'index'])->name('rheological');
	Route::get('pressure-loss', [PressureLossController::class, 'index'])->name('pressure.loss');
	Route::get('ecd', [EquivalentCirculatingController::class, 'index'])->name('ecd');
	Route::get('fmc', [FlowrateMinimumController::class, 'index'])->name('fmc');
});
