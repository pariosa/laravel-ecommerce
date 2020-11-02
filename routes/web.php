<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionsController;
use App\Http\Controllers\Admin\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/testing', 'AdminController@index')->name('testing');

Route::prefix('admin')->group(function(){

    //all admin routes will be defined here
    Route::group(['middleware'=>['admin']], function(){
        Route::get('dashboard', [AdminController::class, 'dashboard']); 
        Route::get('settings', [AdminController::class, 'settings']); 
        Route::get('logout', [AdminController::class, 'logout']);
        Route::post('check-current-password', [AdminController::class, 'checkCurrentPw']);
        Route::post('update-admin-password', [AdminController::class, 'updatePassword']);       

        Route::match(['get','post'], 'update-admin-details', [AdminController::class, 'update']);
        Route::get('sections', [SectionsController::class, 'sections']);
        Route::post('update-section-status', [SectionsController::class, 'updateSectionStatus']);

        Route::get('categories', [CategoryController::class, 'categories']);
        Route::post('update-category-status', [CategoryController::class, 'updateCategoryStatus']);
        Route::match(['get', 'post'],'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory']);

    });

    Route::match(['get','post'], 'login', [AdminController::class, 'login']);

}); 

//Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
//{
//    Route::get('dashboard', 'Admin\AdminController@index');
//});