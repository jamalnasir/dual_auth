<?php


Route::group(['namespace' => 'Frontend'], function() {

    Auth::routes();

    Route::get('/', 'HomeController@index');

});

Route::group(['namespace' => 'Cp', 'prefix'=>'admin'], function() {

    Auth::routes();

    Route::group(['middleware' => 'authAdmin'], function() {
        Route::get('/', 'HomeController@index');
    });

});

