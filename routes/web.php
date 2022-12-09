<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/AddEmployee',[App\Http\Controllers\HomeController::class, 'addemployee']);

Route::post('/SaveEmployeeData',[App\Http\Controllers\HomeController::class, 'saveemployee']);

Route::get('/editEmployee/{id}',[App\Http\Controllers\HomeController::class, 'editemployee']);

Route::put('/updateEmployee/{id}',[App\Http\Controllers\HomeController::class, 'updateEmployee']);


Route::get('/deleteEmployee/{id}',[App\Http\Controllers\HomeController::class, 'deleteEmployee']);

Route::get('/file-export',[App\Http\Controllers\HomeController::class, 'fileExport'])->name('file-export');

Route::get('/sendEmail/{id}', [App\Http\Controllers\HomeController::class, 'NotifyEmail']);