<?php
namespace app\actions;

use app\http\actions\BaseAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class IndexAction extends BaseAction
{
    public function run(ServerRequestInterface $request, array $params = [])
    {
        return $this->render('index', [
            'request' => $request
        ]);
    }
}