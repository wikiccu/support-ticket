<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('new_ticket', 'TicketsController@create');
Route::post('new_ticket', 'TicketsController@store');
Route::get('tickets/{ticket_id}', 'TicketsController@show');
Route::get('my_tickets', 'TicketsController@userTickets');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
	Route::get('tickets', 'TicketsController@index');
	Route::post('close_ticket/{ticket_id}', 'TicketsController@close');
	
	Route::get('tasks', 'TasksController@index');
	Route::post('close_task/{task_id}', 'TasksController@close');
	Route::get('new_task/{ticket_id}', 'TasksController@create');
	Route::post('new_task', 'TasksController@store');
	Route::get('tasks/{task_id}', 'TasksController@show');
	Route::get('my_tasks', 'TasksController@userTasks');
});


Route::post('comment', 'CommentsController@postComment');
