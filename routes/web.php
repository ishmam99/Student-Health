<?php

use App\Http\Controllers\Backend\UserPackageController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ClubController;
use App\Http\Controllers\Backend\InvestController;
use App\Http\Controllers\Backend\InvestUserController;
use App\Http\Controllers\Backend\ObjectionController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\PackageUserController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RankController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\UserController;
// use App\Http\Controllers\Backend\UserInvestController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Backend\WithdrawController;
use App\Http\Controllers\Backend\WithdrawLimitController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\NoticeController;
use App\Http\Resources\UserInvestResource;
use App\Models\UserInvest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get("reboot", function () {
    Artisan::call("view:clear");
    Artisan::call("route:clear");
    Artisan::call("cache:clear");
    Artisan::call("config:clear");
});
Route::get('storageLink', function () {
    Artisan::call("storage:link");
});
Route::get('migrate-fresh', function () {
    Artisan::call("migrate:fresh --seed");
});




    Route::view('/', 'welcome')->name('welcome');
Route::view('chart-view/', 'chart');
// ->middleware('admin');
Route::get('/school/{id}',[ChartController::class,'schoolList']);
    Route::get('student/individual', [ChartController::class, 'student'])->name('student.index');
    Route::get('/report',[ChartController::class,'reportShow'])->name('report.view');
Route::get('/upazila', [ChartController::class, 'upazilaShow'])->name('upazila.view');
Route::get('/calendar', [ChartController::class, 'calendarShow'])->name('calendar.view');
Route::get('/school', [ChartController::class, 'schoolShow'])->name('school.view');
Route::get('/age', [ChartController::class, 'ageShow'])->name('age.view');
    Route::post('graph',[ChartController::class,'graphReport'])->name('graph.report');
    Route::post('upazila',[ChartController::class,'upazilaReport'])->name('upazila.report');
Route::post('calendar', [ChartController::class, 'calendarReport'])->name('calendar.report');
Route::post('age', [ChartController::class, 'ageReport'])->name('age.report');
Route::post('school', [ChartController::class, 'schoolReport'])->name('school.report');
    Route::get('chart',[ChartController::class,'index']);
Route::post('student/report', [ChartController::class, 'report'])->name('student.report');
 
