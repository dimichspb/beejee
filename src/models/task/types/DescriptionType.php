<?php
namespace app\models\task\types;

use app\models\task\Description;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class DescriptionType extends GuidType
{
    const NAME = 'Type\Task\Description';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Description */
        return (string)$value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Description($value);
    }

    public function getName()
    {
        return self::NAME;
    }
}