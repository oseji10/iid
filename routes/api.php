<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\OfficersController;
use App\Http\Controllers\InspectionExtractController;
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


Route::get('/categories', [ItemsController::class, 'retrieveCategories']);
Route::post('/appraised-data-bank/search', [ItemsController::class, 'searchDataBank']);

Route::get('/items', [ItemsController::class, 'RetrieveAll']);
Route::post('/items', [ItemsController::class, 'store']);

Route::get('/departments', [DepartmentsController::class, 'RetrieveAll']);
Route::post('/departments', [DepartmentsController::class, 'store']);

Route::get('/officers', [OfficersController::class, 'RetrieveAll']);
Route::post('/officers', [OfficersController::class, 'store']);

Route::get('/inspection_extract', [InspectionExtractController::class, 'RetrieveAll']);
Route::post('/inspection_extract', [InspectionExtractController::class, 'store']);