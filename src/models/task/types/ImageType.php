<?php
namespace app\models\task\types;

use app\models\task\Image;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class ImageType extends GuidType
{
    const NAME = 'Type\Task\Image';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Image */
        return (string)$value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Image($value);
    }

    public function getName()
    {
        return self::NAME;
    }
}