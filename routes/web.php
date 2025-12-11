<?php

use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Frontend\IndexController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/test', function () {
    return view('test');
});
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('optimize');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');

    return '<h1>Cache facade value cleared</h1>';
});

Route::get('/re', function () {
    Artisan::call('migrate:refresh', [
        '--path' => 'database/migrations/2024_11_12_093838_create_customers_table.php',
    ]);

    return '<h1>Recreate with seed</h1>';
});

Route::get('/', [IndexController::class, 'Home'])->middleware('debugbar.role')->name('home');

Route::get('/table-structure/{table}', [SettingController::class, 'myshow']);

require __DIR__.'/admin.php';

// require __DIR__ . '/auth.php';
