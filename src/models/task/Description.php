<?php
namespace app\models\task;

use app\entities\base\BaseString;
use Assert\Assertion;

class Description extends BaseString
{
    public function assert($value)
    {
        parent::assert($value);
        Assertion::lessOrEqualThan(strlen($value), 1024);
    }

}