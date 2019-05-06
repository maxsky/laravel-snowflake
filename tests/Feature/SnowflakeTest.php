<?php

use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Snowflake\Snowflake;

class SnowflakeTest extends Orchestra\Testbench\TestCase {

    function testNextId() {
        $now = Carbon::now()->getTimestamp();
        $epoch = Carbon::rawParse(config('snowflake.epoch'))->getTimestamp() * 1000;
        $id = app(Snowflake::class)->next();
        $timestamp = $id >> 22;
        $timestamp = ceil(($timestamp + $epoch) / 1000);
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
