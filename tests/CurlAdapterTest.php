<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\Adapter\CurlAdapter;
use Tests\TestCase;

class CurlAdapterTest extends TestCase
{
    /**
     * Test if the get request works.
     *
     * @return void
     */
    public function testGetRequest()
    {
        $adapter  = new CurlAdapter();
        $response = $adapter->get('/posts');
        $this->assertIsArray($response['body']);
        $this->assertEquals(200, $response['statusCode']);
    }

    /**
     * Test if the post request works.
     *
     * @return void
     */
    public function testPostRequest()
    {
        $adapter  = new CurlAdapter();
        $response = $adapter->post('/posts', [
            'title'  => 'foo',
            'body'   => 'bar',
            'userId' => 1,
        ]);
        $this->assertArrayHasKey('id', $response['body']);
    }

    /**
     * Test if the put request works.
     *
     * @return void
     */
    public function testPutRequest()
    {
        $adapter  = new CurlAdapter();
        $response = $adapter->put('/posts/1', [
            'title'  => 'bar',
            'body'   => 'foo',
            'userId' => 2,
            'id'     => 1,
        ]);
        $this->assertEquals('bar', $response['body']['title']);
    }

    /**
     * Test if the delete request works.
     *
     * @return void
     */
    public function testDeleteRequest()
    {
        $adapter  = new CurlAdapter();
        $response = $adapter->delete('/posts/1');
        $this->assertEmpty($response['body']);
    }
}
