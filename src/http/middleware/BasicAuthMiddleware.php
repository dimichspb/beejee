<?php
namespace app\http\middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BasicAuthMiddleware implements MiddlewareInterface
{
    public const ATTRIBUTE = '_user';

    private $access;
    private $responsePrototype;

    public function __construct(array $access, ResponseInterface $responsePrototype)
    {
        $this->access = $access;
        $this->responsePrototype = $responsePrototype;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $username = $request->getServerParams()['PHP_AUTH_USER'] ?? null;
        $password = $request->getServerParams()['PHP_AUTH_PW'] ?? null;

        $path = $request->getUri()->getPath();

        if (!in_array($path, array_keys($this->access))) {
            return $handler->handle($request);
        }

        if (!empty($username) && !empty($password)) {
            foreach ($this->access as $key => $userdata) {
                if ($username === $userdata['username'] && $password === $userdata['password'] && $path === $key) {
                    return $handler->handle($request->withAttribute(self::ATTRIBUTE, $username));
                }
            }
        }

        return $this->responsePrototype
            ->withStatus(401)
            ->withHeader('WWW-Authenticate', 'Basic realm=Restricted area');
    }
}