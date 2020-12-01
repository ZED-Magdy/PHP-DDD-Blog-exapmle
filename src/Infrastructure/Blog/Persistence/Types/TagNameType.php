<?php

namespace App\Infrastructure\Blog\Persistence\Types;

use App\Domain\Blog\ValueObject\TagName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class TagNameType extends StringType
{

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new TagName($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof TagName) {
            return $value->name();
        }
        return $value;
    }

    public function getName()
    {
        return 'TagName';
    }
}
