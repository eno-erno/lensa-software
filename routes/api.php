<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/list-annual-salary', [EmployeeController::class, 'listAnnualSalary']);
Route::delete('/list-annual-salary/{id}', [EmployeeController::class, 'destroy']);
Route::get('/detail-annual-salary/{id}', [EmployeeController::class, 'detailAnnualSalary']);
Route::get('/annual_salary-getnoreg', [EmployeeController::class, 'getnoreg']);
Route::get('/employees/{id}', [EmployeeController::class, 'detail']);
Route::post('/annual_salary', [EmployeeController::class, 'store']);

