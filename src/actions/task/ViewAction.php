<?php
namespace app\actions\task;

use app\http\actions\BaseAction;
use app\http\exceptions\NotFoundException;
use app\http\renderer\RendererInterface;
use app\models\task\Description;
use app\models\task\Done;
use app\models\task\Id;
use app\models\task\Image;
use app\models\task\Task;
use app\models\task\User;
use app\services\task\Service;
use Psr\Http\Message\ServerRequestInterface;

class ViewAction extends BaseAction
{
    protected $service;

    public function __construct(RendererInterface $renderer, Service $service)
    {
        $this->service = $service;

        parent::__construct($renderer);
    }

    public function run(ServerRequestInterface $request, array $params = [])
    {
        $model = $this->findModel(new Id($params['id']));

        return $this->render('task/view', [
            'model' => $model,
        ]);
    }

    protected function findModel(Id $id)
    {
        $model = $this->service->get($id);

        if (is_null($model)) {
            throw new NotFoundException();
        }

        return $model;
    }
}