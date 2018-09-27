<?php
namespace app\models\task;

use app\entities\base\BaseBool;

class Done extends BaseBool
{
    public function __toString(): string
    {
        return $this->getValue()? 'TRUE': 'FALSE';
    }

}