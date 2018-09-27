<?php
namespace app\repositories\task;

use app\models\task\Id;
use app\models\task\Task;
use app\models\task\TaskCollection;

interface RepositoryInterface
{
    public function count(): int;
    public function all(array $orderBy = null, int $offset = null, int $limit = null): TaskCollection;
    public function get(Id $id);
    public function add(Task $task): void;
    public function update(Task $task): void;
    public function delete(Task $task): void;
    public function nextId(): Id;
}