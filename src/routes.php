<?php

namespace Src;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\App;
use \MongoException;
use Sokil\Mongo\Validator\Exception;



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
        return $response->withStatus(200)->withJson($mgProducts->find()->slice('products',1000)->findAll());
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

    $app->post('/product[/]',function(Request $request, Response $response) use ($app){
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

    $app->get('/user/{id}',function(Request $request, Response $response, $id)use($app){
        try {
            $db = $app->getContainer()['db'];
            $mgUser = $db->getCollection('users');
            $route = $request->getAttribute('route');
            $id = $route->getArgument('id');
            $user = $mgUser->getDocument($id);
            if ($user === null) {
                throw new Exception("Not found");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $obj = new \stdClass;
            $obj->message = 'This user does not exists';
            return $response->withStatus(404)->withJson( $obj);
    
        }    
            return $response->withStatus(200)->withJson($user);
    });
    $app->get('/user[/]',function(Request $request, Response $response, array $args) use($app){
        $db = $app->getContainer()['db'];
        $mgUser = $db->getCollection('users');
        return $response->withStatus(200)->withJson($mgUser->find()->slice('users',1000)->findAll());
    });
    $app->post('/user',function(Request $request, Response $response, array $args) use($app){
         $db = $app->getContainer()['db'];
        $mgUser = $db->getCollection('users');
        $datos = $request->getParsedBody();
        $user = $mgUser->createDocument(
            [ 
                'email' => $datos['email'],
                'password' => $datos['password'],
                'country' => $datos['pais']
            ]
        )->save(false);
        return $response->withStatus(201)->withJson($user);
    });
    $app->put('/user/{id}',function(Request $request, Response $response, $id) use($app){
        try {
            $db = $app->getContainer()['db'];
            $mgUser = $db->getCollection('users');
            $route = $request->getAttribute('route');
            $id = $route->getArgument('id'); 
            $data = $mgUser->getDocument($id);
            if ($data === null) {
                throw new Exception("Not found");
            }
            $datos = $request->getParsedBody();
            $user = $data
            ->set('email',$datos['email'])
            ->set('password',(String)$datos['password'])
            ->set('country',$datos['pais'])
            ->save();
            
            }catch (Exception $e) {
                    echo $e->getMessage();
                    $obj = new \stdClass;
                    $obj->message = 'This user cant be updated because does not exist';
                    return $response->withStatus(404)->withJson( $obj);
                }
            return $response->withStatus(202)->withJson($user);
    });
    $app->delete('/user/{id}',function(Request $request, Response $response, $id) use($app){
        try {
            $db = $app->getContainer()['db'];
            $mgUser = $db->getCollection('users');
            $route = $request->getAttribute('route');
            $id = $route->getArgument('id');
            if ($mgUser->getDocument($id)===null){
                throw new Exception("Not found");
            }
            $user = $mgUser->getDocument($id)->delete(); 
            }catch (Exception $e) {
                echo $e->getMessage();
                $obj = new \stdClass;
                $obj->message = 'This user cant be deleted because does not exist';
                return $response->withStatus(404)->withJson( $obj);
            }
            return $response->withStatus(204);
    });
    
    $app->get('/purchase/{userId}',function(Request $request, Response $response, $userId) use($app){
        try {
            $db = $app->getContainer()['db'];
            $mgPurchase = $db->getCollection('purchases');
            $route = $request->getAttribute('route');
            $userId = $route->getArgument('userId');
            $purchase = $mgPurchase->getDocument($userId);
            if ($purchase === null) {
                throw new Exception("Not found");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $obj = new \stdClass;
            $obj->message = 'Those purchases do not exist because the user can not be founded';
            return $response->withStatus(404)->withJson( $obj);
    
        }    
            return $response->withStatus(200)->withJson($purchase);
    });
    $app->get('/purchase',function(Request $request, Response $response, array $args) use($app){
        $db = $app->getContainer()['db'];
        $mgPurchase = $db->getCollection('purchases');
        return $response->withStatus(200)->withJson($mgPurchase->find()->slice('purchases',1000)->findAll());
    });

    $app->post('/purchase[/]',function(Request $request, Response $response, array $args) use($app){
        $db = $app->getContainer()['db'];
        $mgPurchase = $db->getCollection('purchases');
        $datos = $request->getParsedBody();
        $purchase = $mgPurchase->createDocument(
            [ 
                'date' => $datos['fecha'],
                'price' => $datos['precio'],
                'userId' => $datos['usuario'],
                'productId' => $datos['producto']
            ]
        )->save(false);
        return $response->withStatus(201)->withJson($purchase);
    });
/*    $app->put('/purchase/{id}',function(Request $request, Response $response, $id) use($app){ 
    });
    $app->delete('/purchase/{id}',function(Request $request, Response $response, $id) use($app)   
    });
*/
    $app->get('/profile/{id}',function(Request $request, Response $response, $id) use($app){
         try {
            $db = $app->getContainer()['db'];
            $mgProfile = $db->getCollection('profiles');
            $route = $request->getAttribute('route');
            $id = $route->getArgument('id');
            $profile = $mgProfile->getDocument($id);
            if ($profile === null) {
                throw new Exception("Not found");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $obj = new \stdClass;
            $obj->message = 'This profile do not exist';
            return $response->withStatus(404)->withJson( $obj);
    
        }    
            return $response->withStatus(200)->withJson($profile);
    });
   // $app->get('/profile',function(Request $request, Response $response, array $args) use($app){   
   // });
    $app->post('/profile',function(Request $request, Response $response, array $args) use($app){
        $db = $app->getContainer()['db'];
        $mgProfile = $db->getCollection('profiles');
        $datos = $request->getParsedBody();
        $profile = $mgProfile->createDocument(
            [ 
                'userId' => $datos['usuario'],
                'purchaseId' => $datos['compra'],
                'name' => $datos['nombre']
            ]
        )->save(false);
        return $response->withStatus(201)->withJson($profile);
    });
    $app->put('/profile/{id}',function(Request $request, Response $response, $id) use($app){
        try {
            $db = $app->getContainer()['db'];
            $mgProfile = $db->getCollection('profiles');
            $route = $request->getAttribute('route');
            $id = $route->getArgument('id'); 
            $data = $mgProfile->getDocument($id);
            if ($data === null) {
                throw new Exception("Not found");
            }
            $datos = $request->getParsedBody();
            $profile = $data
            ->set('user',$datos['usuario'])
            ->set('purchase',$datos['compra'])
            ->save();
            
            }catch (Exception $e) {
                    echo $e->getMessage();
                    $obj = new \stdClass;
                    $obj->message = 'This profile cant be updated because does not exist';
                    return $response->withStatus(404)->withJson( $obj);
                }
            return $response->withStatus(202)->withJson($profile);
    });
    $app->delete('/profile/{id}',function(Request $request, Response $response, $id) use($app){
        try {
            $db = $app->getContainer()['db'];
            $mgProfile = $db->getCollection('profiles');
            $route = $request->getAttribute('route');
            $id = $route->getArgument('id');
            if ($mgProfile->getDocument($id)===null){
                throw new Exception("Not found");
            }
            $profile = $mgProfile->getDocument($id)->delete(); 
            }catch (Exception $e) {
                echo $e->getMessage();
                $obj = new \stdClass;
                $obj->message = 'This profile cant be deleted because does not exist';
                return $response->withStatus(404)->withJson( $obj);
            }
            return $response->withStatus(204);
    });
});
