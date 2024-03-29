<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RheologicalController;
use App\Http\Controllers\Api\PressureLossController;
use App\Http\Controllers\Api\EquivalentCirculatingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('rheological', [RheologicalController::class, 'index'])->name('rheological');
Route::post('pressure-loss', [PressureLossController::class, 'index'])->name('pressure.loss');

Route::get('dropdown-combination', [PressureLossController::class, 'combination'])->name('pressure.loss.combination');
Route::get('dropdown-drill-pipe', [PressureLossController::class, 'drillPipe'])->name('pressure.loss.drill.pipe');

Route::get('ajax-combination', [PressureLossController::class, 'ajaxCombination'])->name('ajax.combination');
Route::get('ajax-output-surface', [PressureLossController::class, 'ajaxOutputSurface'])->name('ajax.output.surface');
// Route::get('ecd', [EquivalentCirculatingController::class, 'index'])->name('ecd');
