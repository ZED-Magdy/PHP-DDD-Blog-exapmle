<?php

namespace App\Infrastructure\Blog\Persistence\Types;

use App\Domain\Blog\ValueObject\TagId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class TagIdType extends GuidType
{

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return TagId::fromString($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof TagId) {
            return $value->id();
        }
        return $value;
    }

    public function getName()
    {
        return 'TagId';
    }
}
