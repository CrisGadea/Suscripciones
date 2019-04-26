<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;

use function GuzzleHttp\json_decode;

class RoutesTest extends TestCase
{
    private $http;

    public function setUp()
    {
        $this->http = new Client(['base_uri' => 'http://localhost:8080/']);
    }

    public function tearDown() {
        $this->http = null;
    }

    public function testUserGet(){
        
        $perfilesEsperados=[['Id'=>0,'Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com','Suscripciones'=>'Avengers, Jurassic World'],['Id'=>1,'Usuario:'=>'Nacho','Region'=>'Argentina','Email'=>'nacho.gomez@outlook.com','Suscripciones'=>'Avengers, Jurassic World']];
        $response = $this->http->request('GET', 'mock/user');
        $perfilesDevueltos=json_decode($response->getBody()->getContents(),true);
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $this->assertEquals($perfilesEsperados,$perfilesDevueltos);
    }
    public function testUserGetId(){
        
        $perfilEsperado=['Id'=>0,'Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com'];
        $response = $this->http->request('GET', 'mock/user/{id}');
        $perfilDevuelto=json_decode($response->getBody()->getContents(),true);
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $this->assertEquals($perfilEsperado,$perfilDevuelto);
    }
    public function testUserPost(){
        $respuestaEsperada="Su usuario se ha creado correctamente";
        $response = $this->http->request('POST', 'mock/user');
        $respuestaDevuelta=json_decode($response->getBody()->getContents());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals($respuestaEsperada,$respuestaDevuelta);
    }
    public function testUserPut(){
        $mensajeEsperado="Sus datos han sido actualizados";
        $response = $this->http->request('PUT', 'mock/user/{id}');
        $mensajeDevuelto=json_decode($response->getBody()->getContents(),true);
        $this->assertEquals(202, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $this->assertEquals($mensajeEsperado,$mensajeDevuelto);
    }
    public function testUserDelete(){
        $response = $this->http->request('DELETE', 'mock/user/{id}');
        $this->assertEquals(204, $response->getStatusCode());
    }
    public function testProfileGet(){
        $perfilesEsperados=[['Id'=>0,'Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com','Suscripciones'=>'Avengers, Jurassic World'],['Id'=>1,'Usuario:'=>'Nacho','Region'=>'Argentina','Email'=>'nacho.gomez@outlook.com','Suscripciones'=>'Avengers, Jurassic World']];
        $response = $this->http->request('GET', 'mock/profile');
        $perfilesDevueltos=json_decode($response->getBody()->getContents(),true);
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $this->assertEquals($perfilesEsperados,$perfilesDevueltos);
    }
    public function testProfileGetId(){
        $perfilEsperado=['Id'=>0,'Usuario:'=>'Cristian','Region'=>'Argentina','Email'=>'cristianhernangadea@gmail.com','Suscripciones'=>'Avengers, Jurassic World'];
        $response = $this->http->request('GET', 'mock/profile/{id}');
        $perfilDevuelto=json_decode($response->getBody()->getContents(),true);
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $this->assertEquals($perfilEsperado,$perfilDevuelto);
    }
    public function testProfilePost(){
        $respuestaEsperada="El perfil se ha creado exitosamente";
        $response = $this->http->request('POST', 'mock/profile');
        $respuestaDevuelta=json_decode($response->getBody()->getContents());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals($respuestaEsperada,$respuestaDevuelta);
    }
    public function testProfilePut(){
        $mensajeEsperado="Se han modificado los datos";
        $response = $this->http->request('PUT', 'mock/profile/{id}');
        $mensajeDevuelto=json_decode($response->getBody()->getContents(),true);
        $this->assertEquals(202, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $this->assertEquals($mensajeEsperado,$mensajeDevuelto);
    }
    public function testProfileDelete(){
        $response = $this->http->request('DELETE', 'mock/profile/{id}');
        $this->assertEquals(204, $response->getStatusCode());
    }

public function testGetProducts()
{
        $productosEsperados=[['Id'=>0,'Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250],['Id'=>1,'Nombre:'=>'Jurassic World','Descripcion:'=>'Pelicula de dinosaurios','Precio:'=>150],['Nombre:'=>'Rapido y Furioso','Descripcion:'=>'Pelicula de autos','Precio:'=>200]];
        $response = $this->http->request('GET', 'mock/product');
        $productosDevueltos=json_decode($response->getBody()->getContents(),true);
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $this->assertEquals($productosEsperados,$productosDevueltos);
}
public function testGetProduct()
{
        $productoEsperado=['Id'=>0,'Nombre:'=>'Avengers','Descripcion:'=>'Pelicula de superheroes','Precio:'=>250];
        $response = $this->http->request('GET', 'mock/product/{id}');
        $productoDevuelto=json_decode($response->getBody()->getContents(),true);
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $this->assertEquals($productoEsperado,$productoDevuelto);
}
public function testPutProduct()
{
    $productoEsperado="Se han actualizado los datos";
    $response = $this->http->request('PUT', 'mock/product/{id}');
    $productoDevuelto=json_decode($response->getBody()->getContents());
    $this->assertEquals(202, $response->getStatusCode());
    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
    $this->assertEquals($productoEsperado,$productoDevuelto);
}
public function testPostProduct()
{
    $productoEsperado="Se ha suscripto correctamente";
    $response = $this->http->request('POST', 'mock/product');
    $productoDevuelto=json_decode($response->getBody()->getContents());
    $this->assertEquals(201, $response->getStatusCode());
    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
    $this->assertEquals($productoEsperado,$productoDevuelto);
}
public function testDeleteProduct()
{
    $response = $this->http->request('DELETE', 'mock/product/{id}');
    $this->assertEquals(204, $response->getStatusCode());
}

public function testGetPurchase()
{
$usuarioEsperado=[['Usuario'=>'Cristian','Id'=>0,'Producto'=>'Avengers','precio'=>250,'Fecha'=>'12/12/2000'],['Usuario'=>'Nacho', 'Id'=>1,'Producto'=>'Avengers','Precio'=>25,'Fecha'=>'12/12/2000']];
$response = $this->http->request('GET', 'mock/purchase');
$usuarioDevuelto=json_decode($response->getBody()->getContents(),true);
$this->assertEquals(200, $response->getStatusCode());
$contentType = $response->getHeaders()["Content-Type"][0];
$this->assertEquals("application/json", $contentType);
$this->assertEquals($usuarioEsperado,$usuarioDevuelto);
}
public function testGetIdPurchase()
{
$usuarioEsperado=['Usuario'=>'Cristian','Id'=>0,'Producto'=>'Avengers','Precio'=>250,'Fecha'=>'12/12/2000'];
$response = $this->http->request('GET', 'mock/purchase/{id}');
$usuarioDevuelto=json_decode($response->getBody()->getContents(),true);
$this->assertEquals(200, $response->getStatusCode());
$contentType = $response->getHeaders()["Content-Type"][0];
$this->assertEquals("application/json", $contentType);
$this->assertEquals($usuarioEsperado,$usuarioDevuelto);
}
public function testPutPurchase()
{
$respuestaEsperada="Datos modificados correctamente";
$response = $this->http->request('PUT', 'mock/purchase/{id}');
$respuestaDevuelta=json_decode($response->getBody()->getContents());
$contentType = $response->getHeaders()["Content-Type"][0];
$this->assertEquals("application/json", $contentType);
$this->assertEquals(202, $response->getStatusCode());
$this->assertEquals($respuestaEsperada,$respuestaDevuelta);
}
public function testPostPurchase()
{
    $respuestaEsperada="La compra se ha realizado exitosamente";
    $response = $this->http->request('POST', 'mock/purchase');
    $respuestaDevuelta=json_decode($response->getBody()->getContents());
    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals($respuestaEsperada,$respuestaDevuelta);
}
public function testDeletePurchase()
{
$response = $this->http->request('DELETE', 'mock/purchase/{id}');
$this->assertEquals(204, $response->getStatusCode());
}


}
