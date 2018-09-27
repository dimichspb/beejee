<?php
namespace app\http\actions;

use app\http\entities\response\ResponseFactory;
use app\http\renderer\RendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class BaseAction implements ActionInterface
{
    /**
     * @var RendererInterface
     */
    protected $renderer;

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // TODO: Implement handle() method.
    }

    public function render($view, $params = []): ResponseInterface
    {
        return ResponseFactory::fromString($this->renderer->render($view, $params));
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }
}