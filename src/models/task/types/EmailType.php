<?php
namespace app\models\task\types;

use app\models\task\Email;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class EmailType extends GuidType
{
    const NAME = 'Type\Task\Email';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Email */
        return (string)$value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Email($value);
    }

    public function getName()
    {
        return self::NAME;
    }
}