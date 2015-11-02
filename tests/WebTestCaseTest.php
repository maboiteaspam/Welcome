<?php
/*
 * This file is part of the Silex framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Silex\Tests;
use C\Welcome\ControllersProvider;
use Silex\Application;
use Silex\WebTestCase;
/**
 * Functional test cases.
 *
 * @author Igor Wiedler <igor@wiedler.ch>
 */
class WebTestCaseTest extends WebTestCase
{
    public function createApplication()
    {
        $bootHelper = include __DIR__."/../bootstrap.php";
        $app = $bootHelper->app;
        /* @var $welcome ControllersProvider */
        $app->mount('/', $welcome);
        /* @var $app Application */
        $app->boot();
        return $app;
    }
    public function testGetIndex()
    {
        $client = $this->createClient();
        $client->request('GET', '/');
        $response = $client->getResponse();
        $this->assertTrue($response->isSuccessful());
        $this->assertContains('root', $response->getContent());
    }
}