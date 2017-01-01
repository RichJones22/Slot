<?php declare(strict_types=1);
use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('vue-test', function () {
    return ['Laravel', 'Vue', 'PHP', 'JavaScript', 'Tooling'];
});

Route::get('/symbolsUnique', 'SymbolsController@symbolsUnique');
