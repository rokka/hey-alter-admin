<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ConsignmentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\DistributionController;

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

Route::redirect('/', '/login');

Route::get('/HA-{location}-{number}', [ComputerController::class, 'display'])->where('location', '[A-Za-z]+')->where('number', '[0-9]+');

Route::get('/anfrage', [InquiryController::class, 'create']);
Route::post('/anfrage', [InquiryController::class, 'store'])->name("inquiries.store");

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/computers/table', 'App\Http\Controllers\ComputerController@search')->name('computers.table');
    Route::resource('/computers', ComputerController::class);
    Route::get('/schools/table', 'App\Http\Controllers\SchoolController@search')->name('schools.table');
    Route::resource('/schools', SchoolController::class);
    Route::resource('/orders', OrderController::class);
    Route::get('/consignments/created', [ConsignmentController::class, 'created'])->name('consignments.created');
    Route::resource('/consignments', ConsignmentController::class);
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
    Route::resource('/distributions', DistributionController::class);
});