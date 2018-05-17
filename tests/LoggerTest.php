<?php

namespace Railken\LaraOre\RequestLogger\Tests;

use Railken\Bag;
use Railken\LaraOre\RequestLogger\RequestLog\RequestLogManager;

/**
 * Testing logs
 * Attributes
 */
class ConfigTest extends BaseTest
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

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), $this->getParameters());
    }

    public function testNotDefined()
    {
        $manager = $this->getManager();
        $this->assertArraySubset([['code' => 'REQUEST_LOG_TYPE_NOT_DEFINED']], $manager->create($this->getParameters()->remove('type'))->getSimpleErrors()->toArray());
    }

  
}
