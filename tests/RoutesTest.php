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

    public function testGetPurchase()
    {
    $response = $this->http->request('GET', 'mock/purchase');
    $this->assertEquals(200, $response->getStatusCode());
    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
    //$this->assertEquals();
    }
    public function testGetIdPurchase()
    {
    $response = $this->http->request('GET', 'mock/purchase/{id}');
    $this->assertEquals(200, $response->getStatusCode());
    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
    //$this->assertEquals();
    }
    public function testPutPurchase()
    {
    $response = $this->http->request('PUT', 'mock/purchase/{id}');
    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
    $this->assertEquals(202, $response->getStatusCode());
    //$this->assertEquals();
    }
    public function testPostPurchase()
    {
    $response = $this->http->request('POST', 'mock/purchase');
    
    $this->assertEquals(201, $response->getStatusCode());
    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("application/json", $contentType);
    }
    public function testDeletePurchase()
    {
    $response = $this->http->request('DELETE', 'mock/purchase/{id}');
    $this->assertEquals(204, $response->getStatusCode());
    }
}
