<?php

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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'tickets'], function() {
    Route::get('/', 'TicketsController@create');
    Route::get('/user/{user_id}', 'TicketsController@userTickets');
    Route::get('/{ticket_id}', 'TicketsController@show');
    Route::post('/', 'TicketsController@store');
    Route::post('/{ticket_id}/comment', 'CommentsController@postComment');
});


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('tickets', 'TicketsController@index');
    Route::post('toggle_ticket_state/{ticket_id}', 'TicketsController@toggle_state');
});
