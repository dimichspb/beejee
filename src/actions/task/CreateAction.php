<?php
namespace app\actions\task;

use app\forms\task\CreateForm;
use app\http\actions\BaseAction;
use app\http\renderer\RendererInterface;
use app\services\task\Service;
use Psr\Http\Message\ServerRequestInterface;

class CreateAction extends BaseAction
{
    protected $service;

    public function __construct(RendererInterface $renderer, Service $service)
    {
        $this->service = $service;

        parent::__construct($renderer);
    }

    public function run(ServerRequestInterface $request, array $params = [])
    {
        $form = new CreateForm();

        if ($request->getMethod() === 'POST' && $form->load($request->getParsedBody()) && $form->validate()) {
            $task = $this->service->create($form);
            return $this->redirect('/task/' . $task->getId()->getValue());
        }

        return $this->render('task/create', [
            'form' => $form,
        ]);
    }


}