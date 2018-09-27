<?php
namespace app\repositories\task;

use app\models\task\Id;
use app\models\task\Task;
use app\models\task\TaskCollection;
use app\repositories\exceptions\RepositoryException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\Uuid;

class DoctrineRepository implements RepositoryInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $entityRepository;

    /**
     * DoctrineTaskRepository constructor.
     * @param EntityManager $em
     * @param EntityRepository $entityRepository
     */
    public function __construct(EntityManager $em, EntityRepository $entityRepository)
    {
        $this->em = $em;
        $this->entityRepository = $entityRepository;
    }

    /**
     * @param Id $id
     * @return Task|null
     */
    public function get(Id $id)
    {
        try {
            /** @var Task $task */
            $task = $this->entityRepository->find($id);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $task;
    }

    /**
     * @param Task $task
     */
    public function add(Task $task): void
    {
        try {
            $this->em->persist($task);
            $this->em->flush($task);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param Task $task
     */
    public function update(Task $task): void
    {
        try {
            $this->em->flush($task);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param Task $task
     */
    public function delete(Task $task): void
    {
        try {
            $this->em->remove($task);
            $this->em->flush($task);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @return Id
     */
    public function nextId(): Id
    {
        try {
            $id = new Id(Uuid::uuid4()->toString());
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $id;
    }

    /**
     * @param array|null $orderBy
     * @param int $offset
     * @param int $limit
     * @return TaskCollection
     */
    public function all(array $orderBy = null, int $offset = null, int $limit = null): TaskCollection
    {
        try {
            $results = $this->entityRepository->findBy([], $orderBy, $limit, $offset);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return new TaskCollection($results);
    }

    public function count(): int
    {
        return $this->entityRepository->count([]);
    }

}