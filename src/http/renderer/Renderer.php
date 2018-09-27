<?php
namespace app\http\renderer;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Renderer implements RendererInterface
{
    protected $path;
    protected $layout;

    public function __construct($path, $layout)
    {
        $this->path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . $path;
        $this->layout = $layout;
    }

    public function render($view, $params = []): string
    {
        $level = ob_get_level();
        $layoutFile = $this->path . '/layout/' . $this->layout . '.php';
        $templateFile = $this->path . '/' . $view . '.php';

        try {
            ob_start();
            extract($params, EXTR_OVERWRITE);
            require $templateFile;
            $template = ob_get_clean();
            ob_start();
            require $layoutFile;
            $content = ob_get_clean();
        } catch (\Throwable|\Exception $e) {
            while (ob_get_level() > $level) {
                ob_end_clean();
            }
            throw $e;
        }

        return $content;
    }
}