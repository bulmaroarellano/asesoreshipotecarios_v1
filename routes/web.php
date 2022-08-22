<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\PermissionController;

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

        Route::get('applicants', [ApplicantController::class, 'index'])->name(
            'applicants.index'
        );
        Route::post('applicants', [ApplicantController::class, 'store'])->name(
            'applicants.store'
        );
        Route::get('applicants/create', [
            ApplicantController::class,
            'create',
        ])->name('applicants.create');
        Route::get('applicants/{applicant}', [
            ApplicantController::class,
            'show',
        ])->name('applicants.show');
        Route::get('applicants/{applicant}/edit', [
            ApplicantController::class,
            'edit',
        ])->name('applicants.edit');
        Route::put('applicants/{applicant}', [
            ApplicantController::class,
            'update',
        ])->name('applicants.update');
        Route::delete('applicants/{applicant}', [
            ApplicantController::class,
            'destroy',
        ])->name('applicants.destroy');

        Route::get('incomes', [IncomeController::class, 'index'])->name(
            'incomes.index'
        );
        Route::post('incomes', [IncomeController::class, 'store'])->name(
            'incomes.store'
        );
        Route::get('incomes/create', [IncomeController::class, 'create'])->name(
            'incomes.create'
        );
        Route::get('incomes/{income}', [IncomeController::class, 'show'])->name(
            'incomes.show'
        );
        Route::get('incomes/{income}/edit', [
            IncomeController::class,
            'edit',
        ])->name('incomes.edit');
        Route::put('incomes/{income}', [
            IncomeController::class,
            'update',
        ])->name('incomes.update');
        Route::delete('incomes/{income}', [
            IncomeController::class,
            'destroy',
        ])->name('incomes.destroy');

        Route::get('users', [UserController::class, 'index'])->name(
            'users.index'
        );
        Route::post('users', [UserController::class, 'store'])->name(
            'users.store'
        );
        Route::get('users/create', [UserController::class, 'create'])->name(
            'users.create'
        );
        Route::get('users/{user}', [UserController::class, 'show'])->name(
            'users.show'
        );
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name(
            'users.edit'
        );
        Route::put('users/{user}', [UserController::class, 'update'])->name(
            'users.update'
        );
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name(
            'users.destroy'
        );

        Route::get('Pedidos', [OrderController::class, 'index'])->name(
            'orders.index'
        );
        Route::post('Pedidos', [OrderController::class, 'store'])->name(
            'orders.store'
        );
        Route::get('Pedidos/create', [OrderController::class, 'create'])->name(
            'orders.create'
        );
        Route::get('Pedidos/{order}', [OrderController::class, 'show'])->name(
            'orders.show'
        );
        Route::get('Pedidos/{order}/edit', [
            OrderController::class,
            'edit',
        ])->name('orders.edit');
        Route::put('Pedidos/{order}', [OrderController::class, 'update'])->name(
            'orders.update'
        );
        Route::delete('Pedidos/{order}', [
            OrderController::class,
            'destroy',
        ])->name('orders.destroy');
    });
