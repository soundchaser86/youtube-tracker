<?php

use App\Http\Controllers\Api\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1',
], function () {

    // Videos

    Route::group([
        'prefix' => 'videos',
    ], function () {
        Route::controller(VideoController::class)->group(function () {
            Route::get('/', 'index');
        });
    });

});

// 404

Route::fallback(function () {
    return response()->json([
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Endpoint not found.',
    ], Response::HTTP_NOT_FOUND);
});
