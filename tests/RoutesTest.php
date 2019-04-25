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
        
        $response = $this->http->request('GET', 'mock/user');
        //$this->assertDirectoryExists('mock/user');
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }
    public function testUserGetId(){
        
        $response = $this->http->request('GET', 'mock/user/{id}');
        //$this->assertDirectoryExists('mock/user/{id}');
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }
    public function testUserPost(){
        $response = $this->http->request('POST', 'mock/user');
        //$this->assertDirectoryExists('mock/post');
        $this->assertEquals(201, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }
    public function testUserPut(){
        $response = $this->http->request('PUT', 'mock/user/{id}');
        //$this->assertDirectoryExists('mock/put/{id}');
        $this->assertEquals(202, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }
    public function testUserDelete(){
        $response = $this->http->request('DELETE', 'mock/user/{id}');
        //$this->assertDirectoryExists('mock/delete/{id}');
        $this->assertEquals(204, $response->getStatusCode());
    }
    public function testProfileGet(){
        $response = $this->http->request('GET', 'mock/profile');
        //$this->assertDirectoryExists('mock/get');
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }
    public function testProfileGetId(){
        $response = $this->http->request('GET', 'mock/profile/{id}');
        //$this->assertDirectoryExists('mock/get/{id}');
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }
    public function testProfilePost(){
        $response=$this->http->request('POST', 'mock/profile');
        //$this->assertDirectoryExists('mock/profile/{id}');
        $this->assertEquals(201, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }
    public function testProfilePut(){
        $response = $this->http->request('PUT', 'mock/profile/{id}');
        //$this->assertDirectoryExists('mock/put/{id}');
        $this->assertEquals(202, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }
    public function testProfileDelete(){
        $response = $this->http->request('DELETE', 'mock/profile/{id}');
        //$this->assertDirectoryExists('mock/delete/{id}');
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
    $productoDevuelto=json_decode($response->getBody()->getContents(),true);
    $this->assertEquals(202, $response->getStatusCode());
    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
    $this->assertEquals($productoEsperado,$productoDevuelto);
}
public function testPostProduct()
{
    $productoEsperado="Se ha suscripto correctamente";
    $response = $this->http->request('POST', 'mock/product');
    $productoDevuelto=json_decode($response->getBody()->getContents(),true);
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
