<?php
namespace app\http\actions;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

interface ActionInterface extends RequestHandlerInterface
{
    public function run(ServerRequestInterface $request, array $params = []);
}