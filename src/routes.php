<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\App;

// Routes

    $app = new App();

    $app->get('/',function(){
        return "Bienvenido a nuestra plataforma";
    });

    $app->get('/{id}',function(){
        return "Bienvenido a nuestra plataforma";
    });

    $app->group('/mock', function(App $app){

    // Fetch DI Container
    $container = $app->getContainer();

    $basic_auth = new \Slim\HttpBasicAuth\Rule('Cristian', '123', null, '/user');
    $basic_auth2 = new \Slim\HttpBasicAuth\Rule('Nacho', '123', null, '/user');

    // Register provider
    $container->register($basic_auth);
    $container->register($basic_auth2);

    $app->get('/user/{id}',function(Request $request, Response $response, $args){
        return $response->withStatus(200)->withJson(['Id'=>0,'Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com']);
    })->add($basic_auth);
    
    $app->get('/user',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson([['Id'=>0,'Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com','Suscripciones'=>'Avengers, Jurassic World'],['Id'=>1,'Usuario:'=>'Nacho','Region'=>'Argentina','Email'=>'nacho.gomez@outlook.com','Suscripciones'=>'Avengers, Jurassic World']]);
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
        return $response->withStatus(200)->withJson(['Id'=>0,'Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250]);
    });
    $app->get('/product',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson([['Id'=>0,'Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250],['Id'=>1,'Nombre:'=>'Jurassic World','Descripcion:'=>'Pelicula de dinosaurios','Precio:'=>150],['Nombre:'=>'Rapido y Furioso','Descripcion:'=>'Pelicula de autos','Precio:'=>200]]);
    });
    $app->post('/product',function(Request $request, Response $response, array $args){
        return $response->withStatus(201)->withJson("Se ha suscripto correctamente");
    });
    $app->put('/product/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(202)->withJson(['Id'=>0,'Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250]);
    });
    $app->delete('/product/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(204);
    });

    $app->get('/purchase/{id}',function(Request $request, Response $response, $args){
        return $response->withStatus(200)->withJson(['Usuario'=>'Cristian','Id'=>0,'Producto'=>'Avengers','Precio'=>250]);
    });
    $app->get('/purchase',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson(['Usuario'=>'Cristian','Id'=>0,'Producto'=>'Avengers'],['Usuario'=>'Nacho', 'Id'=>0,'Producto'=>'Avengers','Precio'=>25]);
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
        return $response->withStatus(200)->withJson(['Id'=>0,'Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com','Suscripciones'=>'Avengers, Jurassic World']);
    });
    $app->get('/profile',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson([['Id'=>0,'Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com','Suscripciones'=>'Avengers, Jurassic World'],['Id'=>1,'Usuario:'=>'Nacho','Region'=>'Argentina','Email'=>'nacho.gomez@outlook.com','Suscripciones'=>'Avengers, Jurassic World']]);
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
  
    });