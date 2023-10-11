<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostSubCategoryController;

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

Route::get('/', [App\Http\Controllers\ListController::class, 'index']);
Route::post('/post/word', [App\Http\Controllers\ListController::class, 'post']);
Route::post('/post/category', [App\Http\Controllers\PostCategoryController::class, 'index']);
Route::post('/post/sub_category', [App\Http\Controllers\PostSubCategoryController::class, 'index']);
Route::get('/edit/{word_id}', [App\Http\Controllers\EditController::class, 'index']);
Route::post('/edit/{word_id}', [App\Http\Controllers\EditController::class, 'edit']);
Route::post('/quiz/ask', [App\Http\Controllers\QuizController::class, 'ask']);

