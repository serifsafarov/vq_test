<?php

use App\Http\Controllers\StreamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', [StreamController::class, 'list'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'streams'], function () {

        Route::match(['post', 'get'], 'add', [StreamController::class, 'add'])->name('add_stream');

        Route::get('{id}', [StreamController::class, 'get'])->name('get_stream');

    });

});

Route::get('temp/files/{path?}', function (string $path) {
    return Storage::disk('local')->download($path);
})->name('temp_files')->where('path', '(.*)');

require __DIR__ . '/auth.php';
