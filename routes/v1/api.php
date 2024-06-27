<?php

use App\Http\Controllers\API\V1\Auth\LoginAPIController;
use App\Http\Controllers\Api\V1\CuentaController;
use App\Http\Controllers\Api\V1\PedidoController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\API\V1\User\UserAPIController;
use App\Http\Controllers\AuthController;
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

/**
 * rutas cuenta
 */
Route::get('tasks', [TaskController::class, 'all'])->name('get.all.tasks');
Route::post('tasks', [TaskController::class, 'create'])->name('add.tasks');
Route::get('tasks/{id}', [TaskController::class, 'find'])->name('get.id.task');
Route::put('tasks/{id}', [TaskController::class, 'update'])->name('update.tasks');
Route::delete('tasks/{id}', [TaskController::class, 'delete'])->name('delete.task');

/**
 * rutas registro
 */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('user', [AuthController::class, 'getAuthenticatedUser'])->middleware('jwt.auth');




