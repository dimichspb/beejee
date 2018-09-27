<?php
namespace app\http\entities\response;

use app\http\entities\Body;

class ResponseFactory
{
    public static function fromString($string)
    {
        $stream = fopen('php://memory','r+');
        fwrite($stream, $string);
        rewind($stream);

        return new Response(new Body($stream), new StatusCode(StatusCode::OK));
    }
}