<?php
namespace app\http\router;

use app\http\router\entities\route\Route;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;

interface RouterInterface
{
    /**
     * @param MiddlewareInterface $middleware
     * @return void
     */
    public function pipe(MiddlewareInterface $middleware): void;

    /**
     * @param Route $route
     */
    public function route(Route $route): void;

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function dispatch(ServerRequestInterface $request): ResponseInterface;
}