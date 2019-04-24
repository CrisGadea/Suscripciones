<?php

namespace Tests\Functional;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;



class RoutesTest extends TestCase {
    
    public function user(){
        $this->assertEquals();
    }
<<<<<<< HEAD

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

public function testPost()
{

}

public function testDelete()
{

}

=======
>>>>>>> 05ec7604a4d10257ad647de406bb3f7a5bcd3b14
}
