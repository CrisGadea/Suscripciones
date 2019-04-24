<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;

class RoutesTest extends TestCase
{
    private $http;

    public function setUp()
    {
        $this->http = new Client(['base_uri' => 'https://httpbin.org/']);
    }

    public function tearDown() {
        $this->http = null;
    }

    public function testGet()
{
    $response = $this->http->request('GET', 'mock/user-agent');

    $this->assertEquals(200, $response->getStatusCode());

    $contentType = $response->getHeaders()["Content-Type"][0];
    $this->assertEquals("applciation/json", $contentType);

    $userAgent = json_decode($response->getBody())->{"user-agent"};
    $this->assertRegexp('/Guzzle/', $userAgent);
}

public function testPut()
{
    $response = $this->http->request('PUT', 'user-agent', ['http_errors' => false]);

    $this->assertEquals(405, $response->getStatusCode());
}
}
