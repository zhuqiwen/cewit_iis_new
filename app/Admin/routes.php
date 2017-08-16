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

//    $router->get('affiliates', 'CewitAffiliateController@index');
//
//    $router->get('alumni/create', 'CewitAlumController@create');
//    $router->post('alumni/store', 'CewitAlumController@store');







});

