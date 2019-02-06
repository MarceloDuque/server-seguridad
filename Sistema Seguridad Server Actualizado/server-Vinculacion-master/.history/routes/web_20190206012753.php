<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function (){
   return str_random(32);
});

/************************************************************************************************************************/
/*Rutas de Entidades*/
$router->get('/entities', ['uses' => 'EntitiesController@getAllEntities']);
$router->post('/entities', ['uses' => 'EntitiesController@createEntity']);
$router->put('/entities', ['uses' => 'EntitiesController@updateEntity']);

/************************************************************************************************************************/
/*Rutas de Personas*/
$router->get('/persons', ['uses' => 'PersonsController@getAllPersons']);


/************************************************************************************************************************/
/*Rutas de Coordinador*/
$router->get('/coordinators', ['uses' => 'CoordinatorsController@getAllCoordinators']);
$router->post('/coordinators', ['uses' => 'CoordinatorsController@createCoordinator']);
$router->put('/coordinators', ['uses' => 'CoordinatorsController@updateCoordinator']);






