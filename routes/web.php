<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\LanguageController;
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

Route::get('/', function () {
    return redirect('/admin');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/', IndexController::class)->name('index');

    Route::resource('companies', CompanyController::class)
        ->only([
            'index',
            'store',
            'edit',
            'update',
            'destroy',
        ]);

    Route::get('/export/companies', [CompanyController::class, 'exportToExcel'])->name('companies.export');

    Route::resource('employees', EmployeeController::class)
        ->only([
            'index',
            'store',
            'edit',
            'update',
            'destroy',
            ]);

    Route::get('/export/employees', [EmployeeController::class, 'exportToExcel'])->name('employees.export');
});

Route::post('/language-switch', [LanguageController::class, 'languageSwitch'])->name('language.switch');

require __DIR__ . '/auth.php';
