<?php

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
Auth::routes();
Route::view('/', 'home');

Route::controller(Web\ArticleController::class)->group(function () {
    Route::prefix('articles')->group(function () {
        Route::get('/auto-detection', 'getAutoDetectionList');
        Route::get('/manual-detection', 'getManualDetectionList');
        Route::get('/violation', 'getViolationList');
        Route::get('/none-violation', 'getNoneViolationList');
    });
});

Route::controller(Web\AnalysisController::class)->group(function () {
    Route::prefix('analysis')->group(function () {
        Route::get('/', 'index');
        // Route::get('/get-data', 'getGeneralData');
        // Route::get('/get-violation-by-brand', 'getViolationBasedOnBrands');
        // Route::get('/get-violation-by-code', 'getViolationBasedOnCode');
    });
});

Route::controller(Web\AdminController::class)->group(function () {
    Route::prefix('admins')->group(function () {
        Route::middleware(['check.role:admin'])->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'create');
            Route::delete('/{id}', 'delete');
        });
            Route::put('/{id}', 'update');

    });

});

Route::middleware(['auth'])->group(function () {

    Route::view('/user-manual', 'pages/user-manual/index');

    Route::controller(Web\ArticleController::class)->group(function () {
        Route::prefix('articles')->group(function () {
            Route::put('/{id}/switch-progress-status', 'switchArticleProgressStatus');
            Route::put('/{id}/action-moderate', 'moderateArticle');
            Route::put('/{id}/action-reset', 'resetArticleToOriginState');
        });
    });

    Route::prefix('dummy')->group(function () {
        Route::view('/', 'dummy/index');

        Route::controller(DummyController::class)->group(function () {
            Route::prefix('articles')->group(function () {
                Route::get('/', 'articleIndex');
                Route::post('/', 'articleCreate');
                Route::delete('/{id}', 'articelDelete');
            });
        });

        Route::controller(Web\CountryController::class)->group(function () {
            Route::prefix('countries')->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'create');
                Route::put('/{id}', 'update');
                Route::delete('/{id}', 'delete');
            });
        });

        Route::controller(Web\ViolationTypeController::class)->group(function () {
            Route::prefix('violation-types')->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'create');
                Route::put('/{id}', 'update');
                Route::delete('/{id}', 'delete');
            });
        });

        Route::controller(Web\ViolationCodeController::class)->group(function () {
            Route::prefix('violation-code')->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'create');
                Route::put('/{id}', 'update');
                Route::delete('/{id}', 'delete');
            });
        });

        Route::controller(Web\CompanyBrandController::class)->group(function () {
            Route::prefix('company-brands')->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'create');
                Route::put('/{id}', 'update');
                Route::delete('/{id}', 'delete');
            });
        });
    });
});
