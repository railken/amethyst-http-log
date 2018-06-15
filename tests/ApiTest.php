<?php

namespace Railken\LaraOre\RequestLogger\Tests;

use Railken\LaraOre\Support\Testing\ApiTestableTrait;
use Illuminate\Support\Facades\Config;

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
        return Config::get('ore.api.router.prefix').Config::get('ore.request_logger.router.prefix');
    }

    /**
     * Test common requests.
     *
     * @return void
     */
    public function testSuccessCommon()
    {
        $this->signIn();
        $this->commonTest($this->getBaseUrl(), $this->getParameters());
    }
}
