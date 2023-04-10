<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ComputerController;

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('computers', ComputerController::class);

});
