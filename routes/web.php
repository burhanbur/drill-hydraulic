<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [RheologicalController::class, 'index']);

Route::group(['prefix' => 'drill-hydraulic'], function () {
	Route::get('rheological', [RheologicalController::class, 'index'])->name('rheological');
	Route::get('pressure-loss', [PressureLossController::class, 'index'])->name('pressure.loss');
	Route::get('ecd', [EquivalentCirculatingController::class, 'index'])->name('ecd');
	Route::get('fmc', [FlowrateMinimumController::class, 'index'])->name('fmc');
});