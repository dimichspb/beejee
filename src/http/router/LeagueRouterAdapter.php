<?php
namespace app\http\router;

use app\http\actions\BaseAction;
use app\http\router\entities\route\Route;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;

class LeagueRouterAdapter implements RouterInterface
{
    /**
     * @var Router
     */
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function pipe(MiddlewareInterface $middleware): void
    {
        $this->router->middleware($middleware);
    }

    public function route(Route $route): void
    {
        foreach ($route->getMethods()->getValue() as $method) {
            $this->router->map(
                $method,
                $route->getPath()->getValue(),
                function (ServerRequestInterface $request, array $args) use ($route): ResponseInterface {
                    /** @var BaseAction $action */
                    $action = $route->getHandler()->getValue();
                    return $action->run($request, $args);
                }
            );
        }
    }

    public function dispatch(ServerRequestInterface $request): ResponseInterface
    {
        return $this->router->dispatch($request);
    }
}