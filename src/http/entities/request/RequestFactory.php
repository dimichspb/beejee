<?php
namespace app\http\entities\request;

use app\http\entities\Body;

class RequestFactory
{
    public static function fromGlobals()
    {
        $stream = fopen('php://input', 'r');

        return new Request(
            new Body($stream),
            new Uri($_SERVER['REQUEST_URI']),
            new Method($_SERVER['REQUEST_METHOD']),
            new ServerParams($_SERVER)
        );
    }
}