<?php
namespace app\actions\task;

use app\helpers\Pager;
use app\services\task\Service;
use app\http\actions\BaseAction;
use app\http\renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class IndexAction extends BaseAction
{
    const PER_PAGE = 3;

    protected $service;

    public function __construct(RendererInterface $renderer, Service $service)
    {
        $this->service = $service;

        parent::__construct($renderer);
    }

    public function run(ServerRequestInterface $request, array $params = [])
    {
        $pager = new Pager(
            $this->service->count(),
            isset($params['page'])? $params['page']: 1,
            self::PER_PAGE
        );

        $models = $this->service->all(
            [],
            $pager->getOffset(),
            $pager->getLimit()
        );

        return $this->render('task/index', [
            'models' => $models,
            'pager' => $pager,
        ]);
    }

}