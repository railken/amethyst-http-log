<?php

namespace Railken\LaraOre\RequestLog\Attributes\Type;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Respect\Validation\Validator as v;

class TypeAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'type';

    /**
     * Is the attribute required
     * This will throw not_defined exception for non defined value and non existent model.
     *
     * @var bool
     */
    protected $required = true;

    /**
     * Is the attribute unique.
     *
     * @var bool
     */
    protected $unique = false;

    /**
     * List of all exceptions used in validation.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_DEFINED    => Exceptions\RequestLogTypeNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\RequestLogTypeNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\RequestLogTypeNotAuthorizedException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'requestlog.attributes.type.fill',
        Tokens::PERMISSION_SHOW => 'requestlog.attributes.type.show',
    ];

    /**
     * Is a value valid ?
     *
     * @param EntityContract $entity
     * @param mixed          $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        return in_array($value, ['inbound', 'outbound']);
    }
}
