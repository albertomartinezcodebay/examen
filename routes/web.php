<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth'])->name('index');

require __DIR__.'/auth.php';

Route::resource('empresario', App\Http\Controllers\EmpresarioController::class);

Route::post('/empresario/desactivar/{id}', [App\Http\Controllers\EmpresarioController::class, 'deactivate']);

Route::post('/empresario/validarMoneda/{moneda}', [App\Http\Controllers\EmpresarioController::class, 'validarMoneda']);

Route::post('/empresario/validarCodigo/{codigo}', [App\Http\Controllers\EmpresarioController::class, 'validarCodigo']);