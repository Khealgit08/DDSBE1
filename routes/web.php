<?php
/** @var \Laravel\Lumen\Routing\Router $router */
/*
|---------------------------------------------------------------------
-----
| Application Routes
|---------------------------------------------------------------------
-----
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/', function () use ($router) {
    return $router->app->version();
});
// unsecure routes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users1',['uses' => 'User1Controller@getUsers']);
    $router->get('/users1',['uses' => 'User1Controller@getUsers']);
    $router->get('/users1', 'User1Controller@index'); // get all usersrecords
    $router->post('/users1', 'User1Controller@add'); // create new userrecord
    $router->get('/users1/{id}', 'User1Controller@show'); // get user by id
    $router->put('/users1/{id}', 'User1Controller@update'); // update userrecord
    $router->patch('/users1/{id}', 'User1Controller@update'); // update userrecord
    $router->delete('/users1/{id}', 'User1Controller@delete'); // deleterecord
});