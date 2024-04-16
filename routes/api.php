<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LettersController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\API\CarouselItemsController;
use App\Http\Controllers\API\UnitsController;
use App\Http\Controllers\API\OrderController;



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

Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/home', [UnitsController::class, 'index']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    //Admin APIs
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
        Route::get('/user/{id}', 'show');
        Route::put('/user/{id}', 'update')->name('user.update');
        Route::put('/user/email/{id}', 'email')->name('user.email');
        Route::put('/user/password/{id}', 'password')->name('user.password');
        Route::put('/user/image/{id}', 'image')->name('user.image');
        Route::delete('/user/{id}', 'destroy');
    });
    Route::controller(CarouselItemsController::class)->group(function () {
        Route::get('/carousel', 'index');
        Route::get('/carousel/{id}', 'show');
        Route::get('/carousel/all', 'all');
        Route::delete('/carousel/{id}', 'destroy');
        Route::post('/carousel', 'store');
        Route::put('/carousel/{id}', 'update');
    });
    //Units 
    Route::controller(UnitsController::class)->group(function () {
        Route::get('/unit', 'admin_index');
        Route::delete('/unit/{id}', 'destroy');
        Route::post('/unit', 'store');
        Route::put('/unit/{id}', 'update');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::delete('/orders/{id}', 'destroy');
        Route::post('/orders', 'store');
        // Route::put('/orders/{id}', 'update');
    });

    // User specific APIs
    Route::get('/profile/show', [ProfileController::class, 'show']);
    Route::post('/profile/storeInfo', [ProfileController::class, 'storeInfo'])->name('profile.storeInfo');
    Route::put('/profile/updateInfo', [ProfileController::class, 'storeInfo'])->name('profile.updateInfo');
    Route::put('/profile/image', [ProfileController::class, 'image'])->name('profile.image');
    // Route::delete('/profile/{id}', 'destroy');

});


Route::controller(LettersController::class)->group(function () {
    Route::get('/letters', 'index');
    Route::get('/letters/{id}', 'show');
    Route::delete('/letters/{id}', 'destroy');
    Route::put('/letters/{id}', 'update');
    Route::post('/letters', 'store');
});
