<?php
namespace app\http\router\entities\route;

use app\entities\base\BaseEntity;
use app\http\actions\ActionInterface;
use Assert\Assertion;

class Handler extends BaseEntity
{
    public function assert($value)
    {
        Assertion::isInstanceOf($value, ActionInterface::class);
    }
}