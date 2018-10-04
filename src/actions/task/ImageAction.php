<?php
namespace app\actions\task;

use app\http\actions\BaseAction;
use app\http\exceptions\NotFoundException;
use app\http\renderer\RendererInterface;
use app\models\task\Id;
use app\services\task\Service;
use Psr\Http\Message\ServerRequestInterface;

class ImageAction extends BaseAction
{
    protected $service;

    public function __construct(RendererInterface $renderer, Service $service)
    {
        $this->service = $service;

        parent::__construct($renderer);
    }

    public function run(ServerRequestInterface $request, array $params = [])
    {
        $task = $this->findModel(new Id($params['id']));

        $stream = $this->service->getImage($task);

        return $this->raw($stream, ['Content-type' => 'image/jpeg']);
    }

    /**
     * @param Id $id
     * @return mixed
     */
    protected function findModel(Id $id)
    {
        $model = $this->service->get($id);

        if (is_null($model)) {
            throw new NotFoundException();
        }

        return $model;
    }
}