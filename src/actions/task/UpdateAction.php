<?php
namespace app\actions\task;

use app\forms\task\UpdateForm;
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

class UpdateAction extends BaseAction
{
    protected $service;

    public function __construct(RendererInterface $renderer, Service $service)
    {
        $this->service = $service;

        parent::__construct($renderer);
    }

    public function run(ServerRequestInterface $request, array $params = [])
    {
        $id = isset($params['id'])? $params['id']: null;

        $form = new UpdateForm();
        $model = $this->findModel(new Id($id));

        if ($request->getMethod() === 'POST' && $form->load($request->getParsedBody()) && $form->validate()) {
            $task = $this->service->update($form, $model);
            return $this->redirect('/task/' . $task->getId()->getValue());
        }

        $form->description = $form->description?: $model->getDescription()->getValue();
        $form->done = $form->done?: $model->getDone()->getValue();

        return $this->render('task/update', [
            'form' => $form,
        ]);
    }

    /**
     * @param Id $id
     * @return Task
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