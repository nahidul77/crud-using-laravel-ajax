<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');

Route::post('/add-employee', [EmployeeController::class, 'addEmployee'])->name('employee.add');
Route::get('/employee/{id}', [EmployeeController::class, 'getEmployeeById'])->name('employee.getById');
Route::put('/edit-employee', [EmployeeController::class, 'editEmployee'])->name('employee.edit');
Route::delete('/employee/{id}', [EmployeeController::class, 'deleteEmployee'])->name('employee.delete');
Route::delete('/selected-employees', [EmployeeController::class, 'deleteAllChecked'])->name('employee.deleteSelected');