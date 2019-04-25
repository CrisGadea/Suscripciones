<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;

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
}
