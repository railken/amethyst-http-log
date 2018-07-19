<?php

namespace Railken\LaraOre\RequestLog;

use Faker\Factory;
use Railken\Bag;

class RequestLogFaker
{
    /**
     * @return \Railken\Bag
     */
    public static function make()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('method', 'POST');
        $bag->set('url', '/awd');
        $bag->set('request', ['body' => ['id' => 'foo']]);
        $bag->set('response', ['body' => ['id' => 'foo']]);
        $bag->set('time', 20);
        $bag->set('queries_count', 2);

        return $bag;
    }
}
