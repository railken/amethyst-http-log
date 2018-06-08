<?php

namespace Railken\LaraOre\RequestLogger\Tests;

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
        $this->commonTest($this->getManager(), $this->getParameters());
    }

    /** @test */
    public function it_will_search()
    {
        $this->get("test");
        $results = $this->getManager()->getRepository()->newEntity()->search('bazinga')->get();
        $this->assertEquals(1, $results->count());
    }

    /** @test */
    public function it_will_log_request()
    {
        $this->post("test", ['query' => 'foo']);
        $resource = $this->getManager()->getRepository()->findOneBy(['method' => 'POST']);
        $this->assertEquals('foo', $resource->request['body']['query']);
        $this->assertEquals(200, $resource->status);
        $this->assertArraySubset(["body" => "bazinga"], $resource->response);
    }
    
    /** @test */
    public function it_will_return_not_defined_errors()
    {
        $manager = $this->getManager();
        $this->assertArraySubset([['code' => 'REQUEST_LOG_TYPE_NOT_DEFINED']], $manager->create($this->getParameters()->remove('type'))->getSimpleErrors()->toArray());
    }

    /** @test */
    public function it_will_not_log_request()
    {
        $this->post("test", ['password' => 'secret']);
        $resource = $this->getManager()->getRepository()->findOneBy(['method' => 'POST']);
        $this->assertEquals(false, isset($resource->request['body']['password']));
    }
}
