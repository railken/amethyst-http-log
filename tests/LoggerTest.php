<?php

namespace Railken\LaraOre\RequestLogger\Tests;

use Railken\Bag;
use Railken\LaraOre\RequestLogger\RequestLog\RequestLogManager;

/**
 * Testing logs
 * Attributes
 */
class LoggerTest extends BaseTest
{
    use Traits\CommonTrait;
    
    /**
     * Retrieve basic url.
     *
     * @return \Railken\Laravel\Manager\Contracts\ManagerContract
     */
    public function getManager()
    {
        return new RequestLogManager();
    }

    /**
     * Retrieve correct bag of parameters.
     *
     * @return Bag
     */
    public function getParameters()
    {
        $bag = new bag();
        $bag->set('type', 'inbound');
        $bag->set('method', "POST");
        $bag->set('url', "/awd");
        $bag->set('request', json_encode(['body' => ['id' => 'foo']]));
        $bag->set('response', json_encode(['body' => ['id' => 'foo']]));
        return $bag;
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
        $this->get("test");
        $resource = $this->getManager()->getRepository()->findOneBy(['method' => 'GET']);
        $this->assertEquals(200, $resource->status);
        $this->assertArraySubset(["body" => "bazinga"], json_decode($resource->response, true));
    }
    
    /** @test */
    public function it_will_return_not_defined_errors()
    {
        $manager = $this->getManager();
        $this->assertArraySubset([['code' => 'REQUEST_LOG_TYPE_NOT_DEFINED']], $manager->create($this->getParameters()->remove('type'))->getSimpleErrors()->toArray());
    }
}
