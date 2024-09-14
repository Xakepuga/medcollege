<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ListController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonalFileController;
use App\Http\Controllers\ReportController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    /**
     * Личные дела
     */
    Route::prefix('personal-files')->name('personal-files.')->group(function () {

        Route::get('/create-personal-file', [PersonalFileController::class, 'create'])->name('create');
        Route::post('/create-personal-file', [PersonalFileController::class, 'store'])->name('store');

        Route::prefix('manage/personal-file')->name('manage.personal-file.')->group(function () {
            Route::get('/search', [PersonalFileController::class, 'search'])->name('search');
            Route::get('/{id}/view', [PersonalFileController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [PersonalFileController::class, 'edit'])->name('edit');
            Route::post('/{id}/edit', [PersonalFileController::class, 'update'])->name('update');
            Route::delete('/{id}/delete', [PersonalFileController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/export/application', [PersonalFileController::class, 'exportApplicationToWord'])->name('export-app');
        });
    });

    /**
     * Списки
     */
    Route::prefix('students-lists')->name('students-lists.')->group(function () {

        Route::get('/', [ListController::class, 'viewStudentLists'])->name('index');
        Route::get('/search', [ListController::class, 'viewStudentLists'])->name('search');

        Route::prefix('/manage/enrollment')->name('manage.enrollment.')->group(function () {
            Route::get('/', [ListController::class, 'enrollmentManage'])->name('index');
            Route::get('/search', [ListController::class, 'enrollmentManage'])->name('search');
            Route::post('/change-status', [ListController::class, 'changeEnrollmentStatus'])->name('change-status');
        });
    });

    /**
     * Отчётность
     */
    Route::prefix('reporting')->name('reporting.')->group(function () {

        Route::prefix('/application-statistics')->name('statistics.')->group(function () {
            Route::get('/', [ReportController::class, 'showStatistics'])->name('index');
            Route::get('/export-list', [ReportController::class, 'exportStatisticsToExcel'])->name('export-list');
        });

        Route::prefix('/universal-report')->name('universal-report.')->group(function () {
            Route::get('/', [ReportController::class, 'showUniversalReport'])->name('index');
            Route::get('/generate-report', [ReportController::class, 'showUniversalReport'])->name('generate');
            Route::get('/export-list', [ReportController::class, 'exportUniversalReportToExcel'])->name('export-list');
            Route::get('/download', [ReportController::class, 'downloadReport'])->name('download');
        });

        Route::prefix('/rating')->name('rating.')->group(function () {
            Route::get('/', [ReportController::class, 'showRating'])->name('index')->withoutMiddleware([Authenticate::class]);
            Route::get('/generate-rating', [ReportController::class, 'showRating'])->name('generate')->withoutMiddleware([Authenticate::class]);
            Route::get('/export-list/{id}', [ReportController::class, 'exportRatingToWord'])->name('export-list');
        });
    });

    /**
     * Админка
     */
    Route::middleware('is_admin')->group(function () {

        Route::prefix('admin/manage')->name('admin.manage.')->group(function () {

            Route::prefix('users')->name('users.')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/create-user', [UserController::class, 'create'])->name('create');
                Route::post('/create-user', [UserController::class, 'store'])->name('store');

                Route::prefix('user')->name('user.')->group(function () {
                    Route::get('/{id}/profile/view', [UserController::class, 'show'])->name('show');
                    Route::get('/{id}/profile/edit', [UserController::class, 'edit'])->name('edit');
                    Route::post('/{id}/profile/edit', [UserController::class, 'update'])->name('update');
                    Route::delete('/{id}/delete', [UserController::class, 'destroy'])->name('destroy');
                });
            });

            Route::prefix('categories')->name('categories.')->group(function () {

                Route::get('/', [CategoryController::class, 'index'])->name('index');

                Route::prefix('category')->name('category.')->group(function () {
                    Route::get('/{slug}', [CategoryController::class, 'show'])->name('show');
                    Route::post('/create-item', [CategoryController::class, 'store'])->name('store');
                    Route::delete('/item/{id}/delete', [CategoryController::class, 'destroy'])->name('destroy');
                });
            });

            Route::prefix('database')->name('database.')->group(function () {
            });
            Route::prefix('website')->name('website.')->group(function () {
            });
        });
    });
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
