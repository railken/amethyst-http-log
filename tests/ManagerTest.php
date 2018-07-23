<?php

namespace Railken\LaraOre\RequestLogger\Tests;

use Railken\LaraOre\RequestLog\RequestLogFaker;
use Railken\LaraOre\RequestLog\RequestLogManager;
use Railken\LaraOre\Support\Testing\ManagerTestableTrait;

class ManagerTest extends BaseTest
{
    use ManagerTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return \Railken\Laravel\Manager\Contracts\ManagerContract
     */
    public function getManager()
    {
        return new RequestLogManager();
    }

    /** @test */
    public function it_will_work()
    {
        $this->commonTest($this->getManager(), RequestLogFaker::make());
    }

    /** @test */
    public function it_will_log_request()
    {
        $this->post('test', ['query' => 'foo']);
        $resource = $this->getManager()->getRepository()->findOneBy(['method' => 'POST']);
        $this->assertEquals('foo', $resource->request['body']['query']);
        $this->assertEquals(200, $resource->status);
        $this->assertArraySubset(['body' => 'bazinga'], $resource->response);
    }

    /** @test */
    public function it_will_not_log_request()
    {
        $this->post('test', ['password' => 'secret']);
        $resource = $this->getManager()->getRepository()->findOneBy(['method' => 'POST']);
        $this->assertEquals(false, isset($resource->request['body']['password']));
    }
}
