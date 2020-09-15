<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'v1/message', 'as' => 'api.', 'namespace' => 'Api\V1'],
    function () {
        Route::post('/', 'MessageController@sendMessage');
    });
