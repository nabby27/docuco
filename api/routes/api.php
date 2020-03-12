<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/unauthenticated', function () {
  return response()->json(['message' => 'Unauthenticated.']);
})->name('unauthenticated');

Route::get('/', function () {
  return response()->json(['message' => 'Wellcome to Docuco API!']);
})->name('api');

Route::post('/login', 'UserController@login')->name('login.api');

Route::group(['middleware' => ['auth:api']], function () {
  Route::get('/documents', 'DocumentController@get_all_documents')->name('all_documents.api');
  Route::get('/documents/{document_id}', 'DocumentController@get_one_document')->name('one_document.api');

  Route::get('/users', 'UserController@get_all_users')->name('all_user.api');
  Route::get('/users/{user_id}', 'UserController@get_one_user')->name('one_user.api');
});

Route::group(['middleware' => ['auth:api', 'admin_or_edit_role:api']], function () {
  Route::post('/documents', 'DocumentController@create_document')->name('create_document.api');
  Route::put('/documents/{document_id}', 'DocumentController@update_document')->name('update_document.api');
});

Route::group(['middleware' => ['auth:api', 'admin_role:api']], function () {
  Route::delete('/documents/{document_id}', 'DocumentController@delete_document')->name('delete_document.api');
});
