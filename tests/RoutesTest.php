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
