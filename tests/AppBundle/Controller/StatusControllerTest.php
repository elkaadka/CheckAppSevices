<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * class StatusControllerTest
 *
 * test class for status controller
 *
 * @package  AppBundle\Service
 * @author   Adil El Kanabi
 */
class StatusControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/status');
        $response = $client->getResponse();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($response->getContent(), 'Expected response to be a valid JSON');

        $data = json_decode($response->getContent(), true);
        $this->assertTrue(isset($data['APP']));
        $this->assertTrue(isset($data['MYSQL']));
        $this->assertTrue(isset($data['REDIS']));
    }
}
