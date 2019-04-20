<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\App;

// Routes
/**

$app->group('/users/{id:[0-9]+}', function (App $app) {
    $app->map(['GET', 'DELETE', 'PATCH', 'PUT'], '', function ($request, $response, $args) {
        // Find, delete, patch or replace user identified by $args['id']
    })->setName('user');
    $app->get('/reset-password', function ($request, $response, $args) {
        // Route for /users/{id:[0-9]+}/reset-password
        // Reset the password for user identified by $args['id']
    })->setName('user-password-reset');
});

$app->group($pattern, function () {})
    ->add(new SimpleTokenAuthentication($app->getContainer(), $options));
*/
$app = new App();

$app->group('/mock', function(App $app){
    $app->get('/user/{id}',function(Request $request, Response $response, $args){
        return $response->withJson("Hola mundo");
    });

    
    $app->get('/user',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola Mundo");
    });
    $app->post('/user',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });
    $app->put('/user/{id}',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });
    $app->delete('/user/{id}',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });   
});
/**
$app->group('/v1', function(App $app){
    $app->get('/user/{id}',function(Request $request, Response $response, $args){
        return $response->withJson($args,200);
    });
    $app->get('/user',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });
    $app->post('/user',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });
    $app->put('/user/{id}',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });
    $app->delete('/user/{id}',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });
});
*/