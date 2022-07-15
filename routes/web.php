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
        Route::get('/non-violation', 'getNoneViolationList');
        Route::get('/{id}/documents', 'documents');
        Route::get('/{id}/details', 'getOne');
        Route::get('/{id}/violation', 'getOneViolation');
        Route::get('/{id}/non-violation', 'getOneNonViolation');
        Route::post('/manual-label-violation', 'detectArticleManually');
    });
});

Route::controller(Web\AnalysisController::class)->group(function () {
    Route::prefix('analysis')->group(function () {
        Route::get('/', 'index');
        Route::get('/general', 'getGeneralData');
        Route::get('/violation-by-brand', 'getViolationBasedOnBrands');
        Route::get('/violation-by-code', 'getViolationBasedOnCode');
        Route::get('/violation-by-country', 'violationBasedCountries');
    });
});

Route::controller(Web\AdminController::class)->group(function () {
    Route::prefix('admins')->group(function () {
        Route::middleware(['check.role:admin'])->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'create');
            Route::delete('/{id}', 'delete');
            Route::put('/{id}/update-password', 'changePassword');
        });
        Route::put('/{id}', 'update')->middleware('auth');
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

    Route::controller(Web\ArticleLegalDocumentController::class)->group(function () {
        Route::prefix('articles-document')->group(function () {
            Route::post('/upload', 'upload');
            Route::delete('{id}', 'delete');
        });
    });

    Route::prefix('dummy')->group(function () {
        Route::view('/', 'dummy/index');

        Route::controller(DummyController::class)->group(function () {
            Route::prefix('articles')->group(function () {
                Route::get('/', 'dummyArticles');
                Route::delete('/{id}', 'articelDelete');
            });
            Route::prefix('violation-code')->group(function () {
                Route::get('/', 'violationCode');
                Route::post('/', 'createViolationCode');
                Route::put('/{id}', 'updateViolationCode');
                Route::delete('/{id}', 'deleteViolationCode');
            });
            Route::prefix('countries')->group(function () {
                Route::get('/', 'countries');
                Route::post('/', 'createCountries');
                Route::put('/{id}', 'updateCountries');
                Route::delete('/{id}', 'deleteCountries');
            });
            Route::prefix('violation-types')->group(function () {
                Route::get('/', 'violationTypes');
                Route::post('/', 'createViolationTypes');
                Route::put('/{id}', 'updateViolationTypes');
                Route::delete('/{id}', 'deleteViolationTypes');
            });
            Route::prefix('company-brands')->group(function () {
                Route::get('/', 'companyBrands');
                Route::post('/', 'createCompanyBrands');
                Route::put('/{id}', 'updateCompanyBrands');
                Route::delete('/{id}', 'deleteCompanyBrands');
            });
        });
    });
});
