<?php

namespace Tests\Functional;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class RoutesTest extends TestCase {
    private $http;
    
    public function setUp(){
        $this->http = new Client (['base_uri' => 'http://localhost:8080/']);
    }
    public function tearDown(){
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
}
