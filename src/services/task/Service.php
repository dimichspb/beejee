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
    protected $filesystem;

    public function __construct(RepositoryInterface $repository, FilesystemInterface $filesystem)
    {
        $this->repository = $repository;
        $this->filesystem = $filesystem;
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
        $id = $this->repository->nextId();

        $filename = $this->upload($form, $id->getValue());

        $task = new Task(
            $id,
            new User($form->user),
            new Email($form->email),
            new Description($form->description),
            new Image($filename),
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

    /**
     * Upload image
     * @param CreateForm $form
     * @param $filename
     * @return mixed
     */
    public function upload(CreateForm $form, $filename)
    {
        if (!isset($_FILES['image'])) {
            throw new \InvalidArgumentException('Image must be selected');
        }
        $filename = $filename . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $stream = fopen($_FILES['image']['tmp_name'], 'r+');
        $this->filesystem->saveFileToUploadBucket($filename, $stream);
        fclose($stream);

        unlink($_FILES['image']['tmp_name']);

        return $filename;
    }

    /**
     * Get image
     * @param Task $model
     * @return mixed
     */
    public function getImage(Task $model)
    {
        $result = $this->filesystem->getFileFromUploadBucket($model->getImage()->getValue());

        return $result;
    }

    public function count(): int
    {
        return $this->repository->count();
    }
}