<?php

namespace App\Infrastructure\Blog\Persistence\Types;

use App\Domain\Blog\ValueObject\PostId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class PostIdType extends GuidType
{
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return PostId::fromString($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->id();
    }

    public function getName()
    {
        return 'PostId';
    }
}
