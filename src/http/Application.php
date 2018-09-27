<?php
namespace app\http;

use app\http\emitter\EmitterInterface;
use app\http\entities\Body;
use app\http\entities\response\StatusCode;
use app\http\router\entities\route\Handler;
use app\http\router\entities\route\Method;
use app\http\router\entities\route\MethodCollection;
use app\http\router\entities\route\Path;
use app\http\router\entities\route\Route;
use app\http\router\RouterInterface;
use app\http\entities\response\Response;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;


class Application
{
    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var EmitterInterface
     */
    protected $emitter;


    /**
     * Application constructor.
     * @param RouterInterface $router
     * @param EmitterInterface $emitter
     */
    public function __construct(RouterInterface $router, EmitterInterface $emitter)
    {
        $this->router = $router;
        $this->emitter = $emitter;
    }

    public function pipe(MiddlewareInterface $middleware)
    {
        $this->router->pipe($middleware);
    }

    private function route(MethodCollection $methods, Path $path, Handler $handler): void
    {
        $this->router->route(new Route($methods, $path, $handler));
    }

    public function any(Path $path, Handler $handler): void
    {
        $this->route(new MethodCollection(Method::all()), $path, $handler);
    }

    public function get(Path $path, Handler $handler): void
    {
        $this->route(new MethodCollection([
            new Method(Method::GET)
        ]), $path, $handler);
    }

    public function post(Path $path, Handler $handler): void
    {
        $this->route(new MethodCollection([
            new Method(Method::POST)
        ]), $path, $handler);
    }

    public function run(ServerRequestInterface $request): int
    {
        try {
            $response = $this->router->dispatch($request);
        } catch (\app\http\exceptions\NotFoundException $exception) {
            $response = (new Response())->withStatus(404)->withHeader('HTTP/1.0 404 Not Found');
        }
        $this->emitter->emit($response);

        return $response->getStatusCode();
    }
}