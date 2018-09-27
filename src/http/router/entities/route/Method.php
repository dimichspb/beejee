<?php
namespace app\http\router\entities\route;

use app\entities\base\BaseString;
use Assert\Assertion;

class Method extends BaseString
{
    const GET = 'GET';
    const POST = 'POST';

    public function assert($value)
    {
        $value = strtoupper($value);
        Assertion::inArray($value, self::all());
        parent::assert($value);
    }

    public static function all()
    {
        return [
            self::GET,
            self::POST,
        ];
    }
}