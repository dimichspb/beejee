<?php
namespace app\models\task\types;

use app\models\task\Done;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class DoneType extends GuidType
{
    const NAME = 'Type\Task\Done';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Done */
        return (bool)$value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Done((bool)$value);
    }

    public function getName()
    {
        return self::NAME;
    }
}