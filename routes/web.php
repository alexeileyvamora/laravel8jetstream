<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrowserController;
use App\Http\Controllers\ConsultorController;
use App\Http\Controllers\GananciaController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\DashController;

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

Route::get('/', [DashController::class, 'index']);

Route::get('dash', [DashController::class, 'index']);

Route::get('graficos', [BrowserController::class, 'index']);

Route::get('consulta', [ConsultorController::class, 'index']);

Route::resource('/ganancia', GananciaController::class);


Route::get('pizza', [PizzaController::class, 'index']);


