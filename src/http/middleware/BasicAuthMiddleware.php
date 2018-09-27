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

        foreach (array_keys($this->access) as $key) {
            if (strpos($path, $key) === 0) {
                if (!empty($username) && !empty($password)) {
                    foreach ($this->access as $key => $userdata) {
                        if ($username === $userdata['username'] && $password === $userdata['password']) {
                            return $handler->handle($request->withAttribute(self::ATTRIBUTE, $username));
                        }
                    }
                }
                return $this->responsePrototype
                    ->withStatus(401)
                    ->withHeader('WWW-Authenticate', 'Basic realm=Restricted area');
            }
        }

        return $handler->handle($request);
    }
}