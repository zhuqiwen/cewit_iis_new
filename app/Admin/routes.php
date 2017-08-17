<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('users', UserController::class);
    $router->resource('affiliates', CewitAffiliateController::class);
    $router->resource('students', CewitStudentController::class);
    $router->resource('faculties', CewitFacultyController::class);
    $router->resource('staff', CewitStaffController::class);
    $router->resource('alumni', CewitAlumController::class);
    $router->resource('sigs', CewitAlumController::class);
    $router->resource('events', CewitAlumController::class);

    $router->get('/visualizations','CewitVisualizationController@index');










});

