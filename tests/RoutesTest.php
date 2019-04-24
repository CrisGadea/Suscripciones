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
    $response = $this->http->request('GET', 'mock/product');

    $this->assertEquals(200, $response->getStatusCode());

    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
}
public function testGetProduct()
{
    $response = $this->http->request('GET', 'mock/product/{id}');

    $this->assertEquals(200, $response->getStatusCode());

    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
}

public function testPutProduct()
{
    $response = $this->http->request('PUT', 'mock/product/{id}', ['http_errors' => false]);

    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);

    $this->assertEquals(202, $response->getStatusCode());
}

public function testPostProduct()
{
    $response = $this->http->request('POST', 'mock/product');
    
    $this->assertEquals(201, $response->getStatusCode());

    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);

}

public function testDeleteProduct()
{
    $response = $this->http->request('DELETE', 'mock/product/{id}');

    $this->assertEquals(204, $response->getStatusCode());

}
}
