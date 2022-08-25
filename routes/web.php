<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SolicitanteController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::get('all-orders', [PedidosController::class, 'index'])->name(
            'all-pedidos.index'
        );
        Route::post('all-orders', [PedidosController::class, 'store'])->name(
            'all-pedidos.store'
        );
        Route::get('all-orders/create', [
            PedidosController::class,
            'create',
        ])->name('all-pedidos.create');
        Route::get('all-orders/{pedidos}', [
            PedidosController::class,
            'show',
        ])->name('all-pedidos.show');
        Route::get('all-orders/{pedidos}/edit', [
            PedidosController::class,
            'edit',
        ])->name('all-pedidos.edit');
        Route::put('all-orders/{pedidos}', [
            PedidosController::class,
            'update',
        ])->name('all-pedidos.update');
        Route::delete('all-orders/{pedidos}', [
            PedidosController::class,
            'destroy',
        ])->name('all-pedidos.destroy');

        Route::resource('solicitantes', SolicitanteController::class);
    });
