<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PedidosController;
use App\Http\Controllers\Api\IngresoController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\SolicitanteController;
use App\Http\Controllers\Api\SolicitanteIngresosController;
use App\Http\Controllers\Api\SolicitanteAllPedidosController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('all-orders', PedidosController::class);

        Route::apiResource('solicitantes', SolicitanteController::class);

        // Solicitante Incomes
        Route::get('/solicitantes/{solicitante}/ingresos', [
            SolicitanteIngresosController::class,
            'index',
        ])->name('solicitantes.ingresos.index');
        Route::post('/solicitantes/{solicitante}/ingresos', [
            SolicitanteIngresosController::class,
            'store',
        ])->name('solicitantes.ingresos.store');

        // Solicitante Transactions
        Route::get('/solicitantes/{solicitante}/all-pedidos', [
            SolicitanteAllPedidosController::class,
            'index',
        ])->name('solicitantes.all-pedidos.index');
        Route::post('/solicitantes/{solicitante}/all-pedidos', [
            SolicitanteAllPedidosController::class,
            'store',
        ])->name('solicitantes.all-pedidos.store');
    });
