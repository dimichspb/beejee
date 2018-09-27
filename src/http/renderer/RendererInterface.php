<?php
namespace app\http\renderer;

interface RendererInterface
{
    public function render($view, $params = []): string;
}