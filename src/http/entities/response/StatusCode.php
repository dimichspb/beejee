<?php
namespace app\http\entities\response;

use app\entities\base\BaseInteger;
use Assert\Assertion;

class StatusCode extends BaseInteger
{
    const OK = 200;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;

    public function assert($value)
    {
        Assertion::inArray($value, self::all());

        parent::assert($value);
    }

    public static function all()
    {
        return [
            self::OK,
            self::UNAUTHORIZED,
            self::NOT_FOUND,
        ];
    }
}