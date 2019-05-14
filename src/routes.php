<?php

namespace Src;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\App;
use Slim\Container;
use \MongoException;
use Sokil\Mongo\Validator\Exception;
use Sokil\Mongo\Collection;



// Routes
$app->get('/',function(){
    return "Bienvenido a nuestra plataforma";
});
$app->get('/{id}',function(){
    return "Bienvenido a nuestra plataforma";
});
// Fetch DI Container
$container = $app->getContainer();

$app->group('/mock', function(App $app) use ($container){
   /* $basic_auth = new \Slim\HttpBasicAuth\Rule('Cristian', '123', null, '/user');
    $basic_auth2 = new \Slim\HttpBasicAuth\Rule('Nacho', '123', null, '/user');
    // Register provider
    $container->register($basic_auth);
    $container->register($basic_auth2);
*/
    $app->get('/user/{id}',function(Request $request, Response $response, $args) use ($container){
        return $response->withStatus(200)->withJson(['Id'=>0,'Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com']);
    });
    $app->get('/user',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson([['Id'=>0,'Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com','Suscripciones'=>'Avengers, Jurassic World'],['Id'=>1,'Usuario:'=>'Nacho','Region'=>'Argentina','Email'=>'nacho.gomez@outlook.com','Suscripciones'=>'Avengers, Jurassic World']]);
    });
    $app->post('/user',function(Request $request, Response $response, array $args){
        return $response->withStatus(201)->withJson("Su usuario se ha creado correctamente");
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
        return $response->withStatus(202)->withJson("Se han actualizado los datos");
    });
    $app->delete('/product/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(204);
    });

    $app->get('/purchase/{id}',function(Request $request, Response $response, $args){
        return $response->withStatus(200)->withJson(['Usuario'=>'Cristian','Id'=>0,'Producto'=>'Avengers','Precio'=>250,'Fecha'=>'12/12/2000']);
    });
    $app->get('/purchase',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson([['Usuario'=>'Cristian','Id'=>0,'Producto'=>'Avengers','precio'=>250,'Fecha'=>'12/12/2000'],['Usuario'=>'Nacho', 'Id'=>1,'Producto'=>'Avengers','Precio'=>25,'Fecha'=>'12/12/2000']]);
    });
    $app->post('/purchase',function(Request $request, Response $response, array $args){
        return $response->withStatus(201)->withJson("La compra se ha realizado exitosamente");
    });
    $app->put('/purchase/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(202)->withJson("Datos modificados correctamente") ;
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
$app->group('/v1', function(App $app){
    $app->get('/product[/]',function(Request $request, Response $response,$id) use ($app){
        $db = $app->getContainer()['db'];
        $mgProducts = $db->getCollection('products');
        return $response->withStatus(200)->withJson($mgProducts->find()->slice('products',5)->findAll());
    });       


    $app->get('/product/{id}',function(Request $request, Response $response, $id) use ($app){
    try {
        $db = $app->getContainer()['db'];
        $mgProducts = $db->getCollection('products');
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id');
        $product = $mgProducts->getDocument($id);
        if ($product === null) {
            throw new Exception("Not found");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        $obj = new \stdClass;
        $obj->message = 'This product does not exists';
        return $response->withStatus(404)->withJson( $obj);

    }    
        return $response->withStatus(200)->withJson($product);
    
    });
    
    $app->put('/product/{id}',function(Request $request, Response $response, $id) use ($app){
        try {
        $db = $app->getContainer()['db'];
        $mgProducts = $db->getCollection('products');
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id'); 
        $data = $mgProducts->getDocument($id);
        if ($data === null) {
            throw new Exception("Not found");
        }
        $datos = $request->getParsedBody();
        $product = $data
        ->set('name',$datos['nombre'])
        ->set('price',(int)$datos['precio'])
        ->set('description',$datos['descripcion'])
        ->save();
        
        }catch (Exception $e) {
                echo $e->getMessage();
                $obj = new \stdClass;
                $obj->message = 'This product cant be updated because does not exist';
                return $response->withStatus(404)->withJson( $obj);
            }
        return $response->withStatus(202)->withJson($product);
    });

    $app->post('/product',function(Request $request, Response $response) use ($app){
        $db = $app->getContainer()['db'];
        $mgProducts = $db->getCollection('products');
        $datos = $request->getParsedBody();
        $product = $mgProducts->createDocument( 
            [ 
                'name' => $datos['nombre'],
                'price' => $datos['precio'],
                'description' => $datos['descripcion']
            ]
        )->save(false);
        return $response->withStatus(201)->withJson($product);
    });

    $app->delete('/product/{id}',function(Request $request, Response $response, $id) use ($app){
        try {
        $db = $app->getContainer()['db'];
        $mgProducts = $db->getCollection('products');
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id');
        if ($mgProducts->getDocument($id)===null){
            throw new Exception("Not found");
        }
        $product = $mgProducts->getDocument($id)->delete(); 
        }catch (Exception $e) {
            echo $e->getMessage();
            $obj = new \stdClass;
            $obj->message = 'This product cant be deleted because does not exist';
            return $response->withStatus(404)->withJson( $obj);
        }
        return $response->withStatus(204);
    });
/*
    $app->get('/user/{id}',function(Request $request, Response $response, $args){
        return $response->withStatus(200)->withJson();
    });
    $app->get('/user',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson();
    });
    $app->post('/user',function(Request $request, Response $response, array $args){
        return $response->withStatus(201)->withJson();
    });
    $app->put('/user/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(202)->withJson();
    });
    $app->delete('/user/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(204);
    });
    

    $app->get('/purchase/{id}',function(Request $request, Response $response, $args){
        return $response->withStatus(200)->withJson();
    });
    $app->get('/purchase',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson();
    });
    $app->post('/productpurchase',function(Request $request, Response $response, array $args){
        return $response->withStatus(201)->withJson();
    });
    $app->put('/purchase/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(202)->withJson() ;
    });
    $app->delete('/purchase/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(204);
    });

    $app->get('/profile/{id}',function(Request $request, Response $response, $args){
        return $response->withStatus(200)->withJson();
    });
    $app->get('/profile',function(Request $request, Response $response, array $args){
        return $response->withStatus(200)->withJson();
    });
    $app->post('/profile',function(Request $request, Response $response, array $args){
        return $response->withStatus(201)->withJson();
    });
    $app->put('/profile/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(202)->withJson();
    });
    $app->delete('/profile/{id}',function(Request $request, Response $response, array $args){
        return $response->withStatus(204);
    });
*/ 
});
