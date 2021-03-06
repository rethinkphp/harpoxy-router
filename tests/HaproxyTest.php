<?php

namespace rethink\hrouter\tests\services;

use blink\support\Json;
use rethink\hrouter\tests\TestCase;

/**
 * Class HaproxyTest
 *
 * @package rethink\hrouter\tests\services
 */
class HaproxyTest extends TestCase
{
    public function testHaproxyManagement()
    {
        settings()->setMultiple([
            'listen.ports.http' => 8880,
            'listen.ports.https' => 4443,
        ]);

        $haproxy = haproxy();

        $retval = $haproxy->start($output);

        if ($retval != 0) {
            var_dump($output);
        }

        $this->assertEquals(0, $retval);

        sleep(1);

        $this->assertEquals(0, $haproxy->reload());

        sleep(1);

        $this->assertTrue($haproxy->stop());
    }
}