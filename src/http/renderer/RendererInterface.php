<?php
namespace app\http\renderer;

use Psr\Http\Message\StreamInterface;

interface RendererInterface
{
    public function render($view, $params = []): string;
}