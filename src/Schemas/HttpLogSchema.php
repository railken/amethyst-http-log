<?php

namespace Amethyst\Schemas;

use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class HttpLogSchema extends Schema
{
    /**
     * Get all the attributes.
     *
     * @var array
     */
    public function getAttributes()
    {
        return [
            Attributes\IdAttribute::make(),
            Attributes\TextAttribute::make('url')
                ->setRequired(true),
            Attributes\TextAttribute::make('method')
                ->setRequired(true),
            Attributes\TextAttribute::make('ip'),
            Attributes\ArrayAttribute::make('request'),
            Attributes\ArrayAttribute::make('response'),
            Attributes\TextAttribute::make('status'),
            Attributes\NumberAttribute::make('time'),
            Attributes\LongTextAttribute::make('testable'),
            Attributes\TextAttribute::make('authenticable_type'),
            Attributes\TextAttribute::make('authenticable_id'),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
