<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\TankerController;
use App\Models\Fuel;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::controller(QueryController::class)->group(function () {
        Route::get('/dashboard/firstQuery', 'firstQuery')->name('firstQuery');
        Route::get('/dashboard/thirdQuery', 'thirdQuery')->name('thirdQuery');
    });
    Route::controller(BaseController::class)->group(function () {
        Route::get('/bases', 'index')->name('bases');
        Route::post('/base', 'store')->name('base.create');
        Route::patch('/base/{id}', 'update')->name('base.update');
        Route::delete('/base/{id}', 'destroy')->name('base.delete');
    });
    Route::controller(FuelController::class)->group(function () {
        Route::get('/fuels', 'index')->name('fuels');
        Route::post('/fuel', 'store')->name('fuel.create');
        Route::patch('/fuel/{id}', 'update')->name('fuel.update');
        Route::delete('/fuel/{id}', 'destroy')->name('fuel.delete');
    });
    Route::controller(TankerController::class)->group(function () {
        Route::get('/tankers', 'index')->name('tankers');
        Route::post('/tanker', 'store')->name('tanker.create');
        Route::patch('/tanker/{id}', 'update')->name('tanker.update');
        Route::delete('/tanker/{id}', 'destroy')->name('tanker.delete');
    });
    Route::controller(CityController::class)->group(function () {
        Route::get('/cities', 'index')->name('cities');
        Route::post('/city', 'store')->name('city.create');
        Route::patch('/city/{id}', 'update')->name('city.update');
        Route::delete('/city/{id}', 'destroy')->name('city.delete');
    });
    Route::controller(SheetController::class)->group(function () {
        Route::get('/sheets', 'index')->name('sheets');
        Route::post('/sheet', 'store')->name('sheet.create');
        Route::patch('/sheet/{id}', 'update')->name('sheet.update');
        Route::delete('/sheet/{id}', 'destroy')->name('sheet.delete');
    });
    Route::controller(GarageController::class)->group(function () {
        Route::get('/garages', 'index')->name('garages');
        Route::post('/garage', 'store')->name('garage.create');
        Route::patch('/garage/{id}', 'update')->name('garage.update');
        Route::delete('/garage/{id}', 'destroy')->name('garage.delete');
    });
    Route::controller(StatementController::class)->group(function () {
        Route::get('/statements', 'index')->name('statements');
        Route::post('/statement', 'store')->name('statement.create');
        Route::patch('/statement/{id}', 'update')->name('statement.update');
        Route::delete('/statement/{id}', 'destroy')->name('statement.delete');
        Route::post('/statement/{id}/signed', 'signed')->name('statement.signed');
    });
});