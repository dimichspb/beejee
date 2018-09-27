<?php
namespace app\services\task;

use app\forms\task\CreateForm;
use app\forms\task\UpdateForm;
use app\models\task\Description;
use app\models\task\Done;
use app\models\task\Email;
use app\models\task\Id;
use app\models\task\Image;
use app\models\task\Task;
use app\models\task\TaskCollection;
use app\models\task\User;
use app\repositories\task\RepositoryInterface;

class Service
{
    protected $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function all(array $orderBy = [], int $offset = null, int $limit = null): TaskCollection
    {
        return $this->repository->all($orderBy, $offset, $limit);
    }

    public function get(Id $id)
    {
        return $this->repository->get($id);
    }

    public function create(CreateForm $form): Task
    {
        $task = new Task(
            $this->repository->nextId(),
            new User($form->user),
            new Email($form->email),
            new Description($form->description),
            new Image($form->image),
            new Done(false)
        );

        $this->repository->add($task);

        return $task;
    }

    public function update(UpdateForm $form, Task $task): Task
    {
        $task->updateDescription(new Description($form->description));
        $task->updateDone(new Done($form->done));

        $this->repository->update($task);

        return $task;
    }

    public function count(): int
    {
        return $this->repository->count();
    }
}