<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\ApplicantController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ApplicantOrdersController;
use App\Http\Controllers\Api\ApplicantIncomesController;

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

Route::name('api.')->group(function () {
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);

    Route::get('/applicants', [ApplicantController::class, 'index'])->name(
        'applicants.index'
    );
    Route::post('/applicants', [ApplicantController::class, 'store'])->name(
        'applicants.store'
    );
    Route::get('/applicants/{applicant}', [
        ApplicantController::class,
        'show',
    ])->name('applicants.show');
    Route::put('/applicants/{applicant}', [
        ApplicantController::class,
        'update',
    ])->name('applicants.update');
    Route::delete('/applicants/{applicant}', [
        ApplicantController::class,
        'destroy',
    ])->name('applicants.destroy');

    // Applicant Incomes
    Route::get('/applicants/{applicant}/incomes', [
        ApplicantIncomesController::class,
        'index',
    ])->name('applicants.incomes.index');
    Route::post('/applicants/{applicant}/incomes', [
        ApplicantIncomesController::class,
        'store',
    ])->name('applicants.incomes.store');

    // Applicant Orders
    Route::get('/applicants/{applicant}/orders', [
        ApplicantOrdersController::class,
        'index',
    ])->name('applicants.orders.index');
    Route::post('/applicants/{applicant}/orders', [
        ApplicantOrdersController::class,
        'store',
    ])->name('applicants.orders.store');

    Route::get('/incomes', [IncomeController::class, 'index'])->name(
        'incomes.index'
    );
    Route::post('/incomes', [IncomeController::class, 'store'])->name(
        'incomes.store'
    );
    Route::get('/incomes/{income}', [IncomeController::class, 'show'])->name(
        'incomes.show'
    );
    Route::put('/incomes/{income}', [IncomeController::class, 'update'])->name(
        'incomes.update'
    );
    Route::delete('/incomes/{income}', [
        IncomeController::class,
        'destroy',
    ])->name('incomes.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name(
        'users.store'
    );
    Route::get('/users/{user}', [UserController::class, 'show'])->name(
        'users.show'
    );
    Route::put('/users/{user}', [UserController::class, 'update'])->name(
        'users.update'
    );
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name(
        'users.destroy'
    );

    Route::get('/orders', [OrderController::class, 'index'])->name(
        'orders.index'
    );
    Route::post('/orders', [OrderController::class, 'store'])->name(
        'orders.store'
    );
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name(
        'orders.show'
    );
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name(
        'orders.update'
    );
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name(
        'orders.destroy'
    );
});
