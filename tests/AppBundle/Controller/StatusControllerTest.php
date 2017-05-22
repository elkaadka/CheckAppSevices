<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatusControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/status');
        $response = $client->getResponse();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($response->getContent(), 'Expected response to be a valid JSON');
        $this->assertEquals($response->getContent(), '{"APP":false,"MYSQL":false,"REDIS":false}');
    }
}
