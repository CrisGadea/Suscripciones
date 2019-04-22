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
   /* $app->get('/user/{id}',function(Request $request, Response $response, $args){
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
    });*/
    
    $app->get('/product/{id}',function(Request $request, Response $response, $args){
        return $response->withJson(['Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250,200]);
    });
    $app->get('/product',function(Request $request, Response $response, array $args){
        return $response->withJson(['Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250,200],['Nombre:'=>'Jurassic World','Descripcion:'=>'Pelicula de dinosaurios','Precio:'=>150,200],['Nombre:'=>'Rapido y Furioso','Descripcion:'=>'Pelicula de autos','Precio:'=>200,200]);
    });
    $app->post('/product',function(Request $request, Response $response, array $args){
        return $response->withJson(['Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250,200],['Nombre:'=>'Jurassic World','Descripcion:'=>'Pelicula de dinosaurios','Precio:'=>150,200],['Nombre:'=>'Rapido y Furioso','Descripcion:'=>'Pelicula de autos','Precio:'=>200,200]);
    });
    $app->put('/product/{id}',function(Request $request, Response $response, array $args){
        return $response->withJson(['Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250,200]);
    });
    $app->delete('/product/{id}',function(Request $request, Response $response, array $args){
        return $response->withJson(['Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250,200]);
    });
/*
    $app->get('/purchase/{id}',function(Request $request, Response $response, $args){
        return $response->withJson("Hola mundo");
    });
    $app->get('/purchase',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola Mundo");
    });
    $app->post('/purchase',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });
    $app->put('/purchase/{id}',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });
    $app->delete('/purchase/{id}',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });

    $app->get('/profile/{id}',function(Request $request, Response $response, $args){
        return $response->withJson("Hola mundo");
    });
    $app->get('/profile',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola Mundo");
    });
    $app->post('/profile',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });
    $app->put('/profile/{id}',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });
    $app->delete('/profile/{id}',function(Request $request, Response $response, array $args){
        return $response->withJson("Hola mundo");
    });  */
});