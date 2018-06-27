<?php

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

Route::group([
    'namespace' => '\Unite\Contacts\Http\Controllers',
    'middleware' => ['api', 'auth:api', 'authorize'],
    'as' => 'api.'
], function ()
{
    Route::group(['as' => 'contact.', 'prefix' => 'contact'], function ()
    {
        Route::put('{id}',                          ['as' => 'update',                  'uses' => 'ContactController@update']);
        Route::delete('{id}',                       ['as' => 'delete',                  'uses' => 'ContactController@delete']);
    });
});