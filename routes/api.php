<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookApiController;
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
Route::prefix('books')->group(function () {
    Route::get('/', [BookApiController::class, 'index']);          // Retrieve a list of all books
    Route::get('{id}', [BookApiController::class, 'show']);        // Retrieve details of a specific book
    Route::post('/', [BookApiController::class, 'store']);         // Add a new book
    Route::put('{id}', [BookApiController::class, 'update']);      // Update an existing book
    Route::delete('{id}', [BookApiController::class, 'destroy']);  // Delete a book
});
