<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
//Route::get('/logout',[AuthController::class,'logout']);
//Route::get('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

Route::post('/resetPassword',[AuthController::class,'resetPassword']);

//Route::get('/user',[AuthController::class,'user'])->middleware('auth:sanctum');

Route::group(['middleware'=>['auth:sanctum']], function (){
    Route::get('/user',[AuthController::class,'user']);
    Route::get('/logout',[AuthController::class,'logout']);
    Route::post('/resetPassword',[AuthController::class,'resetPassword']);
    Route::post('/UserUpdate',[AuthController::class,'UserUpdate']);
    

});
