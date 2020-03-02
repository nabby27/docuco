<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['auth:api'] ], function () {
    
    Route::get('/documents', 'DocumentController@get_all_documents')->name('all_documents.api');
    Route::get('/documents/{document_id}', 'DocumentController@get_one_document')->name('one_document.api');
    Route::put('/documents/{document_id}', 'DocumentController@update_document')->name('update_document.api');
});
