<?php

namespace Amethyst\Fakers;

use Faker\Factory;
use Railken\Bag;
use Railken\Lem\Faker;

class HttpLogFaker extends Faker
{
    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('method', 'POST');
        $bag->set('url', '/awd');
        $bag->set('request', ['body' => ['id' => 'foo']]);
        $bag->set('response', ['body' => ['id' => 'foo']]);
        $bag->set('time', 20);

        return $bag;
    }
}
