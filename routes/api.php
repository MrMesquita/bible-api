<?php

use App\Http\Controllers\VersesController;
use GuzzleHttp\Psr7\Response;
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

Route::get("/status", function(Request $request) {
    return response()->json(['message' => "Server on"]);
});

Route::get("/verses/{bookRef}/{chapter}", [VersesController::class, "index"]);