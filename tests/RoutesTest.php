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

    public function testGet()
{
    $response = $this->http->request('GET', 'mock/product');

    $this->directoryExists('mock/product/{id}');

    $this->assertEquals(200, $response->getStatusCode());

    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
}
public function testGetId()
{
    $response = $this->http->request('GET', 'mock/product/{id}');

    $this->directoryExists('mock/product/{id}');

    $this->assertEquals(200, $response->getStatusCode());

    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
}

public function testPut()
{
    $response = $this->http->request('PUT', 'mock/product/{id}', ['http_errors' => false]);

    $this->directoryExists('mock/product/{id}');

    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);

    $this->assertEquals(202, $response->getStatusCode());
}

public function testPost()
{
    $response = $this->http->request('POST', 'mock/product');
    
    $this->assertEquals(201, $response->getStatusCode());

}

public function testDelete()
{
    $response = $this->http->request('DELETE', 'mock/product/{id}');

    $this->assertEquals(204, $response->getStatusCode());

}
}
