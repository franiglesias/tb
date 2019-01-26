<?php
declare(strict_types=1);

namespace App\Tests\E2E;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LuckyControllerTest extends WebTestCase
{
    public function testShouldBeAlive(): void
    {
        $uri = '/lucky/number';

        $client = self::createClient();
        $client->request('GET', $uri);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShouldReturnANumberGreaterThanZero(): void
    {
        $uri = '/lucky/number';

        $client = self::createClient();
        $client->request('GET', $uri);
        $contents = $client->getResponse()->getContent();
        $data = json_decode($contents);
        $this->assertGreaterThan(0, $data->number);
    }
}
