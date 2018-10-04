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

    public static function fromStream($stream, array $headers = [])
    {
        $response = new Response(new Body($stream), new StatusCode(StatusCode::OK));

        foreach ($headers as $header => $value) {
            if (is_string($header)) {
                $response = $response->withHeader($header, $value);
            } else {
                $response = $response->withHeader($value);
            }
        }

        return $response;
    }
}