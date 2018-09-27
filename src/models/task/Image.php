<?php
namespace app\models\task;

use app\entities\base\BaseFilename;
use Assert\Assertion;

class Image extends BaseFilename
{
    public function assert($value)
    {
        parent::assert($value);
        Assertion::inArray(pathinfo($value, PATHINFO_EXTENSION), static::allowedExtensions());
        Assertion::lessOrEqualThan(strlen($value), 255);
    }

    public static function allowedExtensions()
    {
        return [
            'jpg',
            'gif',
            'png',
        ];
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}