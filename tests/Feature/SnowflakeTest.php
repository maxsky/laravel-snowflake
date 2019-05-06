<?php

use Illuminate\Foundation\Application;
use Snowflake\Snowflake;
use PHPUnit\Framework\TestCase;

class SnowflakeTest extends TestCase {

    function testNextId() {
        $now = strtotime(date('Y-m-d H:i:s'));
        $epoch = strtotime(config('snowflake.epoch')) * 1000;
        $id = app(Snowflake::class)->next();

        $timestamp = $id >> 22;
        $timestamp = (int)round(($timestamp + $epoch) / 1000);

        $this->assertTrue($timestamp - $now < 3);
    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app) {
        // Setup default database to use sqlite :memory:
        $app['config']->set('snowflake', [
            'epoch' => '2019-05-01 00:00:00',
            'worker_id' => 1,
            'datacenter_id' => 1
        ]);
    }
}
