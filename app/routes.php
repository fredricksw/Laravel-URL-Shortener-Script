<?php


Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@index'
));

Route::post('/make', array(
	'as' => 'make',
	'uses' => 'LinkController@make'
));

Route::get('/{code}', array(
	'as' => 'get',
	'uses' => 'LinkController@get'
));