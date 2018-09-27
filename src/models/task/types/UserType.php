<?php
namespace app\models\task\types;

use app\models\task\User;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class UserType extends GuidType
{
    const NAME = 'Type\Task\User';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value User */
        return (string)$value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new User($value);
    }

    public function getName()
    {
        return self::NAME;
    }
}