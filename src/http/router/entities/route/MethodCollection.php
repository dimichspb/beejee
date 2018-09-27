<?php
namespace app\http\router\entities\route;

use app\entities\base\BaseCollection;

class MethodCollection extends BaseCollection
{
    protected function getClass()
    {
        return Method::class;
    }
}