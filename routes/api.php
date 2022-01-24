<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsersController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/users', [UsersController::class, 'index'])->name('api-user-index');
Route::post('/users', [UsersController::class, 'create'])->name('api-user-create');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('api-user-delete');
