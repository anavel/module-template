<?php

Route::group(
    [
        'prefix' => 'test',
        'namespace' => 'Anavel\Test\Http\Controllers'
    ],
    function () {
        Route::get('/', [
            'as' => 'anavel-test.home',
            'uses' => 'HomeController@index'
        ]);
    });