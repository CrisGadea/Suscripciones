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

    // Fetch DI Container
    $container = $app->getContainer();

    $basic_auth = new \Slim\HttpBasicAuth\Rule('Cristian', '123', null, '/user');
    $basic_auth2 = new \Slim\HttpBasicAuth\Rule('Nacho', '123', null, '/user');

    // Register provider
    $container->register($basic_auth);
    $container->register($basic_auth2);
/*
    $app->get('/user', function ($req, $res, $args) {
    // Show dashboard
    });

    $app->get('/foo', function ($req, $res, $args) {
    // Show custom page
    })->add($basic_auth);
*/

    $app->get('/user/{id}',function(Request $request, Response $response, $args){
        return $response->withStatus(200)->withJson(['Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com','Suscripciones'=>'Avengers, Jurassic World']);
    })->add($basic_auth);
    
    $app->get('/user',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson([['Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com','Suscripciones'=>'Avengers, Jurassic World'],['Usuario:'=>'Nacho','Region'=>'Argentina','Email'=>'nacho.gomez@outlook.com','Suscripciones'=>'Avengers, Jurassic World']]);
    });
    
    $app->post('/user',function(Request $request, Response $response, array $args){
        return $response->withStatus(201)->withJson("Se ha suscripto correctamente");
    });
    $app->put('/user/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(202)->withJson("Sus datos han sido actualizados");
    });
    $app->delete('/user/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(204);
    });
    
    $app->get('/product/{id}',function(Request $request, Response $response, $args){
        return $response->withStatus(200)->withJson(['Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250]);
    });
    $app->get('/product',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson([['Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250],['Nombre:'=>'Jurassic World','Descripcion:'=>'Pelicula de dinosaurios','Precio:'=>150],['Nombre:'=>'Rapido y Furioso','Descripcion:'=>'Pelicula de autos','Precio:'=>200]]);
    });
    $app->post('/product',function(Request $request, Response $response, array $args){
        return $response->withStatus(201)->withJson(['Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250],['Nombre:'=>'Jurassic World','Descripcion:'=>'Pelicula de dinosaurios','Precio:'=>150],['Nombre:'=>'Rapido y Furioso','Descripcion:'=>'Pelicula de autos','Precio:'=>200]);
    });
    $app->put('/product/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(202)->withJson(['Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250]);
    });
    $app->delete('/product/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(204);
    });

    $app->get('/purchase/{id}',function(Request $request, Response $response, $args){
        return $response->withStatus(200)->withJson(['Usuario'=>'Cristian','Producto'=>'Avengers']);
    });
    $app->get('/purchase',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson(['Usuario'=>'Cristian','Productos'=>'Avengers, Jurassic World']);
    });
    $app->post('/purchase',function(Request $request, Response $response, array $args){
        return $response->withStatus(201)->withJson("La compra se ha realizado exitosamente");
    });
    $app->put('/purchase/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(202);
    });
    $app->delete('/purchase/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(204);
    });

    $app->get('/profile/{id}',function(Request $request, Response $response, $args){
        return $response->withStatus(200)->withJson(['Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com','Suscripciones'=>'Avengers, Jurassic World']);
    });
    $app->get('/profile',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson([['Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com','Suscripciones'=>'Avengers, Jurassic World'],['Usuario:'=>'Nacho','Region'=>'Argentina','Email'=>'nacho.gomez@outlook.com','Suscripciones'=>'Avengers, Jurassic World']]);
    });
    $app->post('/profile',function(Request $request, Response $response, array $args){
        return $response->withStatus(201)->withJson("El perfil se ha creado exitosamente");
    });
    $app->put('/profile/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(202)->withJson("Se han modificado los datos");
    });
    $app->delete('/profile/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(204);
    });  
   // $app->run();
    });