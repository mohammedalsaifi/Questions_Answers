<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\Localization;
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

require __DIR__ . '/auth.php';

Route::group([
    'middleware' => ['locale'], //shurtcut middleware name for Localization Middleware from kernel.php in protected $routeMiddleware
], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware([
        'auth',
        'verified',
        // 'password.confirm'
    ])->name('dashboard');



    Route::prefix('tags')->as('tags.')
    ->middleware(['user.type:admin,super admin'])
    ->group(function () {
        Route::get('', [TagsController::class, 'index'])
            ->name('index');
        Route::get('/create', [TagsController::class, 'create'])
            ->name('create');
        Route::post('/', [TagsController::class, 'store'])
            ->name('store');
        Route::get('/{id}/edit', [TagsController::class, 'edit'])
            ->name('edit');
        Route::put('/{id}', [TagsController::class, 'update'])
            ->name('update');
        Route::delete('/{id}', [TagsController::class, 'destroy'])
            ->name('destroy');
    });


    Route::resource('roles', RolesController::class)
    ->middleware('auth', 'user.type:admin,super admin');
    Route::resource('questions', QuestionsController::class);

    Route::get('profile', [UserProfileController::class, 'edit'])
        ->name('profile')
        ->middleware('auth');
    Route::put('profile', [UserProfileController::class, 'update'])
        ->middleware('auth');
    Route::post('answers', [AnswersController::class, 'store'])
        ->middleware('auth')
        ->name('answers.store');
    Route::put('answers/{id}/best', [AnswersController::class, 'best'])
        ->middleware('auth')
        ->name('answers.best');
});
