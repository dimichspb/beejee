<?php
namespace app\models\task;

use app\entities\base\BaseString;
use Assert\Assertion;

class User extends BaseString
{
    public function assert($value)
    {
        parent::assert($value);
        Assertion::lessOrEqualThan(strlen($value), 32);
    }

}