<?php

use Carbon\Carbon;
//$router->post('/', ['uses' => 'AbilityController@prueba']);
/* Rutas con autenticacion*/
//$router->group(['middleware' => []], function () use ($router) 
//{
    /* Rutas para los usuarios*/

    $router->get('/users', ['uses' => 'UserController@getAllUsers']);
    $router->get('/users/{id}', ['uses' => 'UserController@showUser']);
    $router->post('/users/filter', ['uses' => 'UserController@filterUsers']);
    $router->put('/users', ['uses' => 'UserController@updateUser']);
    $router->delete('/users', ['uses' => 'UserController@deleteUser']);
    $router->put('/users/password', ['uses' => 'UserController@updatePassword']);
    $router->put('/users/password/email', ['uses' => 'UserController@sendResetLinkResponse']);
    $router->get('/users/validateUserName/{id}', ['uses' => 'UserController@validateUserName']);
    /**********************************************************************************************************************/

     $router->get('/professionals/companies', ['uses' => 'ProfessionalController@getAppliedCompanies']);
    $router->get('/professionals/{id}', ['uses' => 'ProfessionalController@showProfessional']);
    $router->post('/professionals', ['uses' => 'ProfessionalController@createProfessional']);
    $router->put('/professionals', ['uses' => 'ProfessionalController@updateProfessional']);
    $router->delete('/professionals', ['uses' => 'ProfessionalController@deleteProfessional']);
    /**********************************************************************************************************************/

    /* Rutas para las empresas*/
    $router->get('/companies/professionals', ['uses' => 'CompanyController@getAppliedProfessionals']);
    $router->get('/companies', ['uses' => 'CompanyController@getAllCompanies']);
    $router->get('/companies/{id}', ['uses' => 'CompanyController@showCompany']);
    $router->put('/companies', ['uses' => 'CompanyController@updateCompany']);
    $router->delete('/companies', ['uses' => 'CompanyController@deleteCompany']);
    /******************************************************************************************************************/
   // });



    /* Rutas publicas special*/

    /* Rutas para login y logout*/
    $router->post('/login', ['uses' => 'UserController@login']);
    $router->post('/logout', ['uses' => 'UserController@logout']);
    /**********************************************************************************************************************/

    /* Rutas para registar usuarios (Profesionales y Empresas)*/
    $router->post('/users/createCompanyUser', ['uses' => 'UserController@createCompanyUser']);
    $router->post('/users/createProfessionalUser', ['uses' => 'UserController@createProfessionalUser']);
    /**********************************************************************************************************************/

    /* Rutas para obtener todos los profesionales y ofertas*/
    $router->get('/postulants', ['uses' => 'ProfessionalController@getProfessionals']);
    $router->post('/companies/detachPostulant', ['uses' => 'CompanyController@detachPostulant']);

    $router->get('/totalCompanies', function () {
    $totalCompanies = \App\Company::where('state', 'ACTIVE')->count();
    return response()->json(['totalCompanies' => $totalCompanies], 200);
    });

    $router->get('/totalProfessionals', function () {
    $totalProfessionals = \App\Professional::where('state', 'ACTIVE')->count();
    return response()->json(['totalProfessionals' => $totalProfessionals], 200);
    });
    /**********************************************************************************************************************/

