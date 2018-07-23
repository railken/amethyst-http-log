<?php

namespace Railken\LaraOre\RequestLogger\Tests;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\RequestLog\RequestLogFaker;
use Railken\LaraOre\Support\Testing\ApiTestableTrait;

class ApiTest extends BaseTest
{
    use ApiTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return Config::get('ore.api.router.prefix').Config::get('ore.request-logger.http.admin.router.prefix');
    }

    /**
     * Test common requests.
     */
    public function testSuccessCommon()
    {
        $this->commonTest($this->getBaseUrl(), RequestLogFaker::make());
    }

    /** @test */
    public function it_will_log()
    {
        $this->get('test');
    }
}
