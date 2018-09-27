<?php
namespace app\models\task;

use app\entities\base\BaseCollection;

class TaskCollection extends BaseCollection
{
    protected function getClass()
    {
        return Task::class;
    }
}