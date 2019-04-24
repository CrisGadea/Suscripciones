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

    $this->assertEquals(200, $response->getStatusCode());

    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("applciation/json", $contentType);

    $userAgent = json_decode($response->getBody())->{"user-agent"};
    $this->assertRegexp('/Guzzle/', $userAgent);
}

public function testGetId()
{
    $response = $this->http->request('GET', 'mock/product/{id}');

    $this->assertEquals(200, $response->getStatusCode());

    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("applciation/json", $contentType);

    $userAgent = json_decode($response->getBody())->{"user-agent"};
    $this->assertRegexp('/Guzzle/', $userAgent);
}

public function testPut()
{
    $response = $this->http->request('PUT', 'mock/product', ['http_errors' => false]);

    $this->assertEquals(405, $response->getStatusCode());
}

public function testPost()
{
    $response = $this->http->request('POST', 'mock/product');

}

public function testDelete()
{
    $response = $this->http->request('DELETE', 'mock/product');

}
}
