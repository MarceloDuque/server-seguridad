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

/*Las rutas siempre deben ir en plural*/

/************************************************************************************************************************/
/*Rutas de Carrera x*/
$router->get('/careers', ['uses' => 'CareersController@getAllCareers']);
$router->post('/careers', ['uses' => 'CareersController@createCareer']);
$router->put('/careers', ['uses' => 'CareersController@updateCareer']);


/************************************************************************************************************************/
/*Rutas de tipo de entidad (x)*/
$router->get('/entity_types', ['uses' => 'EntityTypesController@getAllTypes']);
$router->post('/entity_types', ['uses' => 'EntityTypesController@createEntityType']);
$router->put('/entity_types', ['uses' => 'EntityTypesController@updateEntityType']);

/************************************************************************************************************************/
/*Rutas de Entidades*/
$router->get('/entities', ['uses' => 'EntitiesController@getAllEntities']);
$router->post('/entities', ['uses' => 'EntitiesController@createEntity']);
$router->put('/entities', ['uses' => 'EntitiesController@updateEntity']);

/************************************************************************************************************************/
/*Rutas de Personas*/
$router->get('/persons', ['uses' => 'PersonsController@getAllPersons']);

/************************************************************************************************************************/
/*Rutas de Proyectos*/
$router->get('/projects', ['uses' => 'ProjectsController@getAllProjects']);
$router->post('/projects', ['uses' => 'ProjectsController@createProject']);
$router->put('/projects', ['uses' => 'ProjectsController@createProject']);

/************************************************************************************************************************/
/*Rutas de Convenios*/
$router->get('/agreements', ['uses' => 'AgreementsController@getAllAgreements']);
$router->post('/agreements', ['uses' => 'AgreementsController@createAgreement']);
$router->put('/agreements', ['uses' => 'AgreementsController@updateAgreement']);

/************************************************************************************************************************/
/*Rutas de Estudiantes*/
$router->get('/students', ['uses' => 'StudentsController@getAllStudents']);

/************************************************************************************************************************/
/*Rutas de Coordinador*/
$router->get('/coordinators', ['uses' => 'CoordinatorsController@getAllCoordinators']);
$router->post('/coordinators', ['uses' => 'CoordinatorsController@createCoordinator']);
$router->put('/coordinators', ['uses' => 'CoordinatorsController@updateCoordinator']);

/************************************************************************************************************************/
/*Rutas de Tutores asignados*/
$router->get('/tutors', ['uses' => 'TutorsController@getAllTutors']);
$router->post('/tutors', ['uses' => 'TutorsController@createTutor']);
$router->put('/tutors', ['uses' => 'TutorsController@updateTutor']);





