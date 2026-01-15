<?php

use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Frontend\IndexController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

Route::get('/append', function () {

    if (! app()->isLocal()) {
        // optional safety check
        // abort(403);
    }

    if (! Schema::hasColumn('billing', 'old_payment')) {
        DB::statement('
            ALTER TABLE billing
            ADD old_payment INT NULL
            AFTER transaction_no
        ');

        return 'Column old_payment added successfully';
    }

    return 'Column already exists';
});

Route::get('/re', function () {
    Artisan::call('migrate:rollback', [
        '--path' => 'database/migrations/2024_11_17_173827_billing.php',
    ]);

    Artisan::call('migrate', [
        '--path' => 'database/migrations/2024_11_17_173827_billing.php',
    ]);

    return '<h1>Billing table recreated</h1>';
});

Route::get('/', [IndexController::class, 'Home'])->name('home');

Route::get('/table-structure/{table}', [SettingController::class, 'myshow']);

require __DIR__.'/admin.php';

// require __DIR__ . '/auth.php';
