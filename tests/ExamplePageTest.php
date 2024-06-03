<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExamplePageTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/example');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'ExampleController');
    }
}
