<?php

use App\Http\Controllers\WatchListController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Public Routes
Route::post('/auth/register',[UserController::class,'register']);
Route::post('/auth/login',[UserController::class,'login']);
Route::get('/watchlist',[WatchListController::class,'index'])->name('watchlist');
Route::post('/add',[WatchListController::class,'store'])->name('add');
Route::get('/movie-status/{movie_id}',[WatchListController::class, 'show']);
Route::delete('/destroy',[WatchListController::class,'destroy']);

// Protected Routes
Route::group(["middleware" => ["auth:sanctum"]], function (){
    // user
    Route::post('/logout',[UserController::class,'logout']);
    //list

});



