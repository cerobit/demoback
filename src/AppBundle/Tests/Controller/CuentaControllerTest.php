<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CuentaControllerTest extends WebTestCase
{
    public function testCuentas()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Cuentas');
    }

}
