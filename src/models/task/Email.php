<?php
namespace app\models\task;

use app\entities\base\BaseString;
use Assert\Assertion;

class Email extends BaseString
{
    public function assert($value)
    {
        parent::assert($value);
        Assertion::lessOrEqualThan(strlen($value), 64);
        Assertion::email($value);
    }

}