<?php

namespace App\Infrastructure\Blog\Persistence\Types;

use App\Domain\Blog\ValueObject\CategoryId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class CategoryIdType extends GuidType
{

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if($value !== null){
            return CategoryId::fromString($value);
        }
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if(is_string($value) || $value == null) {
            return $value;
        }
        if($value instanceof CategoryId) {
            return $value->id();
        }
    }

    public function getName()
    {
        return 'CategoryId';
    }
}
